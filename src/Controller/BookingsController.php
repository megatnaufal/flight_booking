<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 */
class BookingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Bookings->find()
            ->contain(['Passengers', 'Flights'])
            ->order(['Bookings.id' => 'ASC']);
        $bookings = $this->paginate($query);

        $this->set(compact('bookings'));
    }

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $booking = $this->Bookings->get($id, contain: ['Passengers', 'Flights', 'Luggages']);
        $visualId = $this->Bookings->find()->where(['id <=' => $id])->count();
        $this->set(compact('booking', 'visualId'));
    }

    // ... (omitted methods)

    public function edit($id = null)
    {
        $booking = $this->Bookings->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $passengers = $this->Bookings->Passengers->find('list', limit: 200)->all();
        $flights = $this->Bookings->Flights->find('list', limit: 200)->all();
        $visualId = $this->Bookings->find()->where(['id <=' => $id])->count();
        $this->set(compact('booking', 'passengers', 'flights', 'visualId'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $departureFlightData = $session->read('Flight.Departure');
        $returnFlightData = $session->read('Flight.Return');

        if (!$departureFlightData) {
            // Manual Admin Booking Flow
            $booking = $this->Bookings->newEmptyEntity();
            if ($this->request->is('post')) {
                $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
                if (!$booking->booking_date) {
                    $booking->booking_date = date('Y-m-d');
                }
                if ($this->Bookings->save($booking)) {
                    $this->Flash->success(__('The booking has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The booking could not be saved. Please, try again.'));
            }
            
            $passengers = $this->Bookings->Passengers->find('list', ['keyField' => 'id', 'valueField' => 'full_name'])->all();
            $flights = $this->Bookings->Flights->find('list', [
                'keyField' => 'id', 
                'valueField' => function ($e) { return $e->flight_number . ' (' . $e->departure_time . ')'; }
            ])->all();
            
            $isManual = true;
            // Set dummy variables to avoid view errors
            $this->set(compact('booking', 'passengers', 'flights', 'isManual'));
            $this->set('departureFlightData', null);
            $this->set('returnFlightData', null);
            $this->set('totalPax', 0);
            $this->set('totalPrice', 0);
            $this->set('totalTaxes', 0);
            $this->set('paxAdult', 0);
            $this->set('paxChild', 0);
            $this->set('paxInfant', 0);
            $this->set('basePerAdult', 0);
            $this->set('basePerChild', 0);
            $this->set('basePerInfant', 0);
            return;
        }
        
        // Fetch Airport details
        $airportsTable = $this->fetchTable('Airports');
        
        // Enrich Departure Data
        if (!empty($departureFlightData['origin_airport_id'])) {
            $origin = $airportsTable->get($departureFlightData['origin_airport_id']);
            $departureFlightData['origin_airport_code'] = $origin->airport_code;
            $departureFlightData['origin_city'] = $origin->city;
        }
        if (!empty($departureFlightData['dest_airport_id'])) {
            $dest = $airportsTable->get($departureFlightData['dest_airport_id']);
            $departureFlightData['dest_airport_code'] = $dest->airport_code;
            $departureFlightData['dest_city'] = $dest->city;
        }
        
        // Enrich Return Data
        if ($returnFlightData) {
            if (!empty($returnFlightData['origin_airport_id'])) {
                $origin = $airportsTable->get($returnFlightData['origin_airport_id']);
                $returnFlightData['origin_airport_code'] = $origin->airport_code;
                $returnFlightData['origin_city'] = $origin->city;
            }
            if (!empty($returnFlightData['dest_airport_id'])) {
                $dest = $airportsTable->get($returnFlightData['dest_airport_id']);
                $returnFlightData['dest_airport_code'] = $dest->airport_code;
                $returnFlightData['dest_city'] = $dest->city;
            }
        }

        $booking = $this->Bookings->newEmptyEntity();
        
        // Handle Form Submission (Checkout)
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // 1. Recreate and Save Flight from Session Data
            $flightsTable = $this->fetchTable('Flights');
            $flight = $flightsTable->newEmptyEntity();
            
            // Generate Mock Flight Number matching airline
            $airline = $departureFlightData['airline_name'] ?? 'Airline';
            $code = 'FL';
            if (strpos($airline, 'AirAsia') !== false) $code = 'AK';
            elseif (strpos($airline, 'Malaysia') !== false) $code = 'MH';
            elseif (strpos($airline, 'Batik') !== false) $code = 'OD';
            elseif (strpos($airline, 'Firefly') !== false) $code = 'FY';
            
            $flightNumber = $code . rand(100, 9999);
            
            // Map Session Data to Entity
            // Note: date objects in session might be strings or objects depending on serialization.
            // FlightController stores them as DateTime objects, but Session read might give strings?
            // CakePHP marshal should handle strings if valid format.
            $flight = $flightsTable->patchEntity($flight, [
                'flight_number' => $flightNumber,
                'origin_airport_id' => $departureFlightData['origin_airport_id'],
                'dest_airport_id' => $departureFlightData['dest_airport_id'],
                'departure_time' => $departureFlightData['departure_time'],
                'arrival_time' => $departureFlightData['arrival_time'],
                'base_price' => $departureFlightData['base_price'],
                'airline_name' => $airline,
            ]);

            if (!$flightsTable->save($flight)) {
                 $this->Flash->error('System Error: Could not save flight details. ' . json_encode($flight->getErrors()));
                 return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }
            
            // Save Booking Logic
            $passengersTable = $this->fetchTable('Passengers');
            $leadPassengerId = null;

            // Extract All Passengers Data to process
            $allPassengersData = [];
            if (!empty($data['passengers']['adult'])) {
                foreach ($data['passengers']['adult'] as $idx => $p) {
                    $p['type'] = 'Adult';
                    $allPassengersData[] = $p; 
                }
            }
            if (!empty($data['passengers']['child'])) {
                foreach ($data['passengers']['child'] as $idx => $p) {
                    $p['type'] = 'Child';
                    $allPassengersData[] = $p;
                }
            }
            if (!empty($data['passengers']['infant'])) {
                foreach ($data['passengers']['infant'] as $idx => $p) {
                    $p['type'] = 'Infant';
                    $allPassengersData[] = $p;
                }
            }
            
            // Save Lead Passenger (First Adult)
            $leadPax = null;
            if (!empty($allPassengersData)) {
                $leadData = $allPassengersData[0];
                // Verify User ID exists to prevent foreign key errors (stale sessions)
                $userId = $session->read('Auth.id');
                if ($userId && !$this->fetchTable('Users')->exists(['id' => $userId])) {
                    $userId = null;
                }

                $leadPax = $passengersTable->newEmptyEntity();
                $leadPax = $passengersTable->patchEntity($leadPax, [
                    'full_name' => trim(($leadData['first_name'] ?? '') . ' ' . ($leadData['last_name'] ?? '')),
                    'phone_number' => $leadData['phone_number'] ?? '',
                    'email' => $leadData['email'] ?? '',
                    'dob' => $leadData['dob'] ?? null,
                    'type' => $leadData['type'] ?? 'Adult',
                    'user_id' => $userId,
                ]);
                if (empty($leadPax->passport_number)) {
                    $leadPax->passport_number = 'P' . rand(10000000, 99999999);
                }
                if ($passengersTable->save($leadPax)) {
                    $leadPassengerId = $leadPax->id;
                } else {
                    $this->Flash->error('System Error: Could not save lead passenger details. ' . json_encode($leadPax->getErrors()));
                    return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
                }
            }

            // Create Booking
            $booking = $this->Bookings->newEmptyEntity();
            $booking->passenger_id = $leadPassengerId;
            $booking->flight_id = $flight->id; 
            $booking->booking_date = date('Y-m-d');
            $booking->ticket_status = 'Pending Payment';
            if (empty($booking->seat_number)) {
                $rows = range(1, 30);
                $cols = ['A', 'B', 'C', 'D', 'E', 'F'];
                $booking->seat_number = $rows[array_rand($rows)] . $cols[array_rand($cols)];
            }
            
            if ($this->Bookings->save($booking)) {
                
                // 1. Update Lead Passenger with Booking ID
                if ($leadPassengerId) {
                    $leadPax = $passengersTable->get($leadPassengerId);
                    $leadPax->booking_id = $booking->id;
                    $passengersTable->save($leadPax);
                }

                // 2. Save Remaining Passengers
                array_shift($allPassengersData); // Remove lead
                
                foreach ($allPassengersData as $pData) {
                    $pax = $passengersTable->newEmptyEntity();
                    $pax = $passengersTable->patchEntity($pax, [
                        'full_name' => trim(($pData['first_name'] ?? '') . ' ' . ($pData['last_name'] ?? '')),
                        'phone_number' => $pData['phone_number'] ?? '',
                        'email' => $pData['email'] ?? '',
                        'dob' => $pData['dob'] ?? null,
                        'type' => $pData['type'] ?? '',
                        'booking_id' => $booking->id,
                        'user_id' => $userId,
                    ]);
                    if (empty($pax->passport_number)) {
                        $pax->passport_number = 'P' . rand(10000000, 99999999);
                    }
                    $passengersTable->save($pax);
                }
                
                // 3. Update Session Passenger List for Payment View
                $passengerList = [];
                if (!empty($data['passengers']['adult'])) {
                   foreach ($data['passengers']['adult'] as $p) {
                       $passengerList[] = ['name' => ($p['first_name'] ?? '') . ' ' . ($p['last_name'] ?? ''), 'type' => 'Adult'];
                   }
                }
                if (!empty($data['passengers']['child'])) {
                   foreach ($data['passengers']['child'] as $p) {
                       $passengerList[] = ['name' => ($p['first_name'] ?? '') . ' ' . ($p['last_name'] ?? ''), 'type' => 'Child'];
                   }
                }
                if (!empty($data['passengers']['infant'])) {
                   foreach ($data['passengers']['infant'] as $p) {
                       $passengerList[] = ['name' => ($p['first_name'] ?? '') . ' ' . ($p['last_name'] ?? ''), 'type' => 'Infant'];
                   }
                }
                $session->write('Flight.PassengerList', $passengerList);
                
                // Handle Return Flight (if exists)
                if ($returnFlightData) {
                    $returnFlight = $flightsTable->newEmptyEntity();
                    
                    // Generate Mock Flight Number for Return
                    $airlineRet = $returnFlightData['airline_name'] ?? 'Airline';
                    $codeRet = 'FL';
                    if (strpos($airlineRet, 'AirAsia') !== false) $codeRet = 'AK';
                    elseif (strpos($airlineRet, 'Malaysia') !== false) $codeRet = 'MH';
                    elseif (strpos($airlineRet, 'Batik') !== false) $codeRet = 'OD';
                    elseif (strpos($airlineRet, 'Firefly') !== false) $codeRet = 'FY';
                    $flightNumberRet = $codeRet . rand(100, 9999);
                    
                    $returnFlight = $flightsTable->patchEntity($returnFlight, [
                        'flight_number' => $flightNumberRet,
                        'origin_airport_id' => $returnFlightData['origin_airport_id'],
                        'dest_airport_id' => $returnFlightData['dest_airport_id'],
                        'departure_time' => $returnFlightData['departure_time'],
                        'arrival_time' => $returnFlightData['arrival_time'],
                        'base_price' => $returnFlightData['base_price'],
                        'airline_name' => $airlineRet,
                    ]);
                    $flightsTable->save($returnFlight);
                    
                    $returnBooking = $this->Bookings->newEmptyEntity();
                    $returnBooking->passenger_id = $leadPassengerId;
                    $returnBooking->flight_id = $returnFlight->id;
                    $returnBooking->booking_date = date('Y-m-d');
                    $returnBooking->ticket_status = 'Pending Payment';
                    if (empty($returnBooking->seat_number)) {
                        $rows = range(1, 30);
                        $cols = ['A', 'B', 'C', 'D', 'E', 'F'];
                        $returnBooking->seat_number = $rows[array_rand($rows)] . $cols[array_rand($cols)];
                    }
                    $this->Bookings->save($returnBooking);
                    
                    $session->write('Flight.ReturnBookingId', $returnBooking->id);
                }

                return $this->redirect(['action' => 'payment', $booking->id]);
            }
            $this->Flash->error(__('The booking could not be saved. Error: ' . json_encode($booking->getErrors())));
        }

        // Calculate Totals
        $paxAdult = (int)($departureFlightData['passengers_adult'] ?? 1);
        $paxChild = (int)($departureFlightData['passengers_child'] ?? 0);
        $paxInfant = (int)($departureFlightData['passengers_infant'] ?? 0);
        $totalPax = $paxAdult + $paxChild + $paxInfant;
        
        $basePerAdult = (float)($departureFlightData['base_price'] ?? 0) + (float)($returnFlightData['base_price'] ?? 0);
        $basePerChild = $basePerAdult;
        $basePerInfant = $basePerAdult * 0.5;
        
        $taxesPerPax = 45.00;
        $totalTaxes = $taxesPerPax * $totalPax;

        $totalPrice = ($basePerAdult * $paxAdult) + ($basePerChild * $paxChild) + ($basePerInfant * $paxInfant) + $totalTaxes;
        
        $this->set(compact('booking', 'departureFlightData', 'returnFlightData', 'paxAdult', 'paxChild', 'paxInfant', 'totalPax', 'totalPrice', 'totalTaxes', 'basePerAdult', 'basePerChild', 'basePerInfant'));
    }

    public function payment($id = null)
    {
        $booking = $this->Bookings->get($id, [
            'contain' => ['Passengers']
        ]);
        $session = $this->request->getSession();
        $departureFlightData = $session->read('Flight.Departure');
        $returnFlightData = $session->read('Flight.Return');
        
        if (!$departureFlightData) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
        }
        
        // Ensure Airport Codes are present (Reuse logic from add, or extract to private method. I'll duplicate for safety/speed)
        $airportsTable = $this->fetchTable('Airports');
        if (!empty($departureFlightData['origin_airport_id'])) {
            $origin = $airportsTable->get($departureFlightData['origin_airport_id']);
            $departureFlightData['origin_airport_code'] = $origin->airport_code;
        }
        if (!empty($departureFlightData['dest_airport_id'])) {
            $dest = $airportsTable->get($departureFlightData['dest_airport_id']);
            $departureFlightData['dest_airport_code'] = $dest->airport_code;
        }
         if ($returnFlightData) {
            if (!empty($returnFlightData['origin_airport_id'])) {
                $origin = $airportsTable->get($returnFlightData['origin_airport_id']);
                $returnFlightData['origin_airport_code'] = $origin->airport_code;
            }
            if (!empty($returnFlightData['dest_airport_id'])) {
                $dest = $airportsTable->get($returnFlightData['dest_airport_id']);
                $returnFlightData['dest_airport_code'] = $dest->airport_code;
            }
        }

        // Calculate Totals again for Payment View
        $paxAdult = (int)($departureFlightData['passengers_adult'] ?? 1);
        $paxChild = (int)($departureFlightData['passengers_child'] ?? 0);
        $paxInfant = (int)($departureFlightData['passengers_infant'] ?? 0);
        $totalPax = $paxAdult + $paxChild + $paxInfant;
        
        $passengerList = $session->read('Flight.PassengerList') ?? [];
        if (empty($passengerList) && $booking->has('passenger')) {
             // Fallback if session missing but DB has lead
             $passengerList[] = ['name' => $booking->passenger->full_name, 'type' => 'Adult 1'];
        }

        $basePerAdult = (float)($departureFlightData['base_price'] ?? 0) + (float)($returnFlightData['base_price'] ?? 0);
        $basePerChild = $basePerAdult;
        $basePerInfant = $basePerAdult * 0.5;
        $taxesPerPax = 45.00;
        $totalTaxes = $taxesPerPax * $totalPax;
        $totalPrice = ($basePerAdult * $paxAdult) + ($basePerChild * $paxChild) + ($basePerInfant * $paxInfant) + $totalTaxes;

        $this->set(compact('booking', 'totalPrice', 'departureFlightData', 'returnFlightData', 'paxAdult', 'passengerList'));
    }

    public function complete($id = null)
    {
        $this->request->allowMethod(['post']);
        $booking = $this->Bookings->get($id);
        $session = $this->request->getSession();
        
        // Mark as Paid
        $booking->ticket_status = 'Confirmed';
        
        // Save Payment Method
        $method = $this->request->getData('payment_method');
        if ($method === 'Internet Banking') {
            $bankName = $this->request->getData('bank_name');
            if ($bankName) {
                // Formatting Bank Name for better display: Maybank2u -> Maybank2u, Public Bank -> Public Bank
                // The keys in array were 'Maybank2u' etc which are readable.
                $method .= " ($bankName)";
            }
        }
        $booking->payment_method = $method;
        
        if ($this->Bookings->save($booking)) {
            
            // Confirm Return Booking if exists
            $returnBookingId = $session->read('Flight.ReturnBookingId');
            if ($returnBookingId) {
                $returnBooking = $this->Bookings->get($returnBookingId);
                $returnBooking->ticket_status = 'Confirmed';
                $returnBooking->payment_method = $method;
                $this->Bookings->save($returnBooking);
            }
            
            // Clear session flight data
            $session->delete('Flight');
            
            $this->Flash->success(__('Payment successful! Your booking is confirmed. Airpaz Code: ' . $booking->id));
            
            $redirectUrl = ['action' => 'confirmation', $booking->id];
            if ($returnBookingId) {
                $redirectUrl['?']['return_id'] = $returnBookingId;
            }
            
            return $this->redirect($redirectUrl);
        }
        $this->Flash->error(__('Payment failed. Please try again.'));
        return $this->redirect(['action' => 'payment', $id]);
    }
    
    public function confirmation($id = null)
    {
        $booking = $this->Bookings->get($id, [
            'contain' => ['Passengers', 'Flights' => ['OriginAirports', 'DestAirports']]
        ]);
        
        $returnBookingId = $this->request->getQuery('return_id');
        $returnBooking = null;
        if ($returnBookingId) {
            $returnBooking = $this->Bookings->get($returnBookingId, [
                'contain' => ['Flights' => ['OriginAirports', 'DestAirports']]
            ]);
        }
        
        $this->set(compact('booking', 'returnBooking'));
    }

    /**
     * Download Receipt method
     * Generates a printable receipt for the booking
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders receipt view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function downloadReceipt($id = null)
    {
        $booking = $this->Bookings->get($id, [
            'contain' => [
                'Passengers', 
                'Flights' => ['OriginAirports', 'DestAirports']
            ]
        ]);
        
        // Use lead passenger from booking (the relationship is Booking belongsTo Passenger)
        $passengers = [];
        if ($booking->passenger) {
            $passengers[] = $booking->passenger;
        }
        
        // Check for return booking
        $returnBookingId = $this->request->getQuery('return_id');
        $returnBooking = null;
        if ($returnBookingId) {
            $returnBooking = $this->Bookings->get($returnBookingId, [
                'contain' => ['Flights' => ['OriginAirports', 'DestAirports']]
            ]);
        }
        
        // Calculate total price (departure + return if exists)
        $departurePrice = (float)($booking->flight->base_price ?? 0);
        $returnPrice = $returnBooking ? (float)($returnBooking->flight->base_price ?? 0) : 0;
        $taxPerPax = 45.00;
        $totalPassengers = max(count($passengers), 1);
        $totalPrice = (($departurePrice + $returnPrice) * $totalPassengers) + ($taxPerPax * $totalPassengers);
        
        $this->set(compact('booking', 'returnBooking', 'passengers', 'totalPrice', 'departurePrice', 'returnPrice'));
        
        // Use ajax layout for clean print output
        $this->viewBuilder()->setLayout('ajax');
    }


    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
