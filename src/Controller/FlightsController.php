<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Flights Controller
 *
 * @property \App\Model\Table\FlightsTable $Flights
 */
class FlightsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Flights->find()
            ->contain(['OriginAirports', 'DestAirports']);
        $flights = $this->paginate($query);

        $this->set(compact('flights'));
    }

    /**
     * View method
     *
     * @param string|null $id Flight id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $flight = $this->Flights->get($id, contain: ['OriginAirports', 'DestAirports', 'Bookings']);
        $this->set(compact('flight'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $flight = $this->Flights->newEmptyEntity();
        if ($this->request->is('post')) {
            $flight = $this->Flights->patchEntity($flight, $this->request->getData());
            if ($this->Flights->save($flight)) {
                $this->Flash->success(__('The flight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flight could not be saved. Please, try again.'));
        }
        $originAirports = $this->Flights->OriginAirports->find('list', limit: 200)->all();
        $destAirports = $this->Flights->DestAirports->find('list', limit: 200)->all();
        $this->set(compact('flight', 'originAirports', 'destAirports'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Flight id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $flight = $this->Flights->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flight = $this->Flights->patchEntity($flight, $this->request->getData());
            if ($this->Flights->save($flight)) {
                $this->Flash->success(__('The flight has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flight could not be saved. Please, try again.'));
        }
        $originAirports = $this->Flights->OriginAirports->find('list', limit: 200)->all();
        $destAirports = $this->Flights->DestAirports->find('list', limit: 200)->all();
        $this->set(compact('flight', 'originAirports', 'destAirports'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Flight id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flight = $this->Flights->get($id);
        if ($this->Flights->delete($flight)) {
            $this->Flash->success(__('The flight has been deleted.'));
        } else {
            $this->Flash->error(__('The flight could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /**
     * Search method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function search()
    {
        $originAirportId = $this->request->getQuery('origin_airport_id');
        $destAirportId = $this->request->getQuery('dest_airport_id');
        $departureDate = $this->request->getQuery('departure');

        $searchResults = [];
        $originAirport = null;
        $destAirport = null;

        $airportsTable = $this->fetchTable('Airports');
        $airports = $airportsTable->find('list', [
            'keyField' => 'id',
            'valueField' => function ($airport) {
                return $airport->city . ' (' . $airport->airport_code . ')';
            }
        ])->all()->toArray();

        if ($originAirportId && $destAirportId && $departureDate) {
            $originAirport = $airportsTable->get($originAirportId);
            $destAirport = $airportsTable->get($destAirportId);

            $searchResults = $this->_generateFlights($originAirport, $destAirport, $departureDate);
        }
        
        $this->set(compact('searchResults', 'airports'));
    }

    /**
     * Select Departure Flight method
     */
    public function selectDeparture()
    {
        $this->request->allowMethod(['post']);
        
        $flightData = $this->request->getData();
        $journeyType = $flightData['journey_type'] ?? 'One Way';
        
        // Write to Session
        $session = $this->request->getSession();
        $session->write('Flight.Departure', $flightData);
        
        if ($journeyType === 'Round Trip') {
             return $this->redirect(['action' => 'searchReturn']);
        }

        // If One Way, go to booking
        return $this->redirect(['controller' => 'Bookings', 'action' => 'add']);
    }

    /**
     * Search Return Flight method
     */
    public function searchReturn()
    {
        $session = $this->request->getSession();
        $departureFlight = $session->read('Flight.Departure');

        if (!$departureFlight) {
            $this->Flash->error('Please select a departure flight first.');
            return $this->redirect(['action' => 'index']); 
        }

        // Setup search params based on Departure Flight selections but INVERTED
        $originAirportId = $departureFlight['dest_airport_id']; 
        $destAirportId = $departureFlight['origin_airport_id'];
        $departureDate = $departureFlight['return_date']; 
        
        // Mock query params for view compatibility
        $this->request = $this->request->withQueryParams([
            'origin_airport_id' => $originAirportId,
            'dest_airport_id' => $destAirportId,
            'departure' => $departureDate,
            'passengers_adult' => $departureFlight['passengers_adult'],
            'passengers_child' => $departureFlight['passengers_child'],
            'passengers_infant' => $departureFlight['passengers_infant'],
            'flight_class' => $departureFlight['flight_class'],
            'journey_type' => 'Round Trip',
            'return' => '', 
        ]);
        
        $airportsTable = $this->fetchTable('Airports');
        $airports = $airportsTable->find('list', [
            'keyField' => 'id',
            'valueField' => function ($airport) {
                return $airport->city . ' (' . $airport->airport_code . ')';
            }
        ])->all()->toArray();
        
        $originAirport = $airportsTable->get($originAirportId);
        $destAirport = $airportsTable->get($destAirportId);

        $searchResults = $this->_generateFlights($originAirport, $destAirport, $departureDate);
        
        $this->set(compact('searchResults', 'airports', 'departureFlight'));
    }
    
    /**
     * Select Return Flight method
     */
    public function selectReturn()
    {
        $this->request->allowMethod(['post']);
        
        $flightData = $this->request->getData();
        
        // Write to Session
        $session = $this->request->getSession();
        $session->write('Flight.Return', $flightData);
        
        // Redirect to Booking
        return $this->redirect(['controller' => 'Bookings', 'action' => 'add']);
    }

    /**
     * Generate flights based on real-time factors
     */
    protected function _generateFlights($originAirport, $destAirport, $date)
    {
        // Mock Coordinates for Malaysian Airports (Lat, Lon)
        $coords = [
            'KUL' => [2.7433, 101.6981], // KLIA
            'PEN' => [5.2925, 100.2745], // Penang
            'BKI' => [5.9372, 116.0512], // Kota Kinabalu
            'KCH' => [1.4851, 110.3430], // Kuching
            'LGK' => [6.3297, 99.7344],  // Langkawi
            'JHB' => [1.6368, 103.6697], // Johor Bahru
            'MYY' => [4.3218, 113.9877], // Miri
            'TGG' => [5.3826, 103.1026], // Kuala Terengganu
        ];

        $origCode = $originAirport->airport_code;
        $destCode = $destAirport->airport_code;
        
        $coord1 = $coords[$origCode] ?? [3.1390, 101.6869]; // Default KL
        $coord2 = $coords[$destCode] ?? [3.1390, 101.6869];

        $distanceKm = $this->_calculateDistance($coord1[0], $coord1[1], $coord2[0], $coord2[1]);
        
        // If distance is very small (same city?), set min 100km
        if ($distanceKm < 50) $distanceKm = 100;

        // --- Calculate Logic ---
        // Speed: ~750 km/h avg
        // Taxi/Landing overhead: 30-40 mins
        $flightDurationHours = ($distanceKm / 750) + 0.5; 
        $durationMinutes = (int)($flightDurationHours * 60);
        
        // Price Base: RM 0.15 - 0.25 per km depending on route type
        $isEastWest = ($origCode === 'KUL' && in_array($destCode, ['BKI', 'KCH', 'MYY'])) || 
                      (in_array($origCode, ['BKI', 'KCH', 'MYY']) && $destCode === 'KUL');
                      
        $ratePerKm = $isEastWest ? 0.12 : 0.20; // Cheaper rate for longer east-west routes usually
        $baseFare = $distanceKm * $ratePerKm;
        
        // Add Taxes and Surcharges
        $taxes = 45; 
        $minPrice = $baseFare + $taxes;
        $maxPrice = $minPrice * 2.5; // Last minute / high demand range

        // --- Generation ---
        $allAirlines = [
            ['name' => 'AirAsia', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/AirAsia_New_Logo.svg/1200px-AirAsia_New_Logo.svg.png', 'premium' => 1.0],
            ['name' => 'Batik Air Malaysia', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Batik_Air_logo.svg/2560px-Batik_Air_logo.svg.png', 'premium' => 1.1],
            ['name' => 'Malaysia Airlines', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Malaysia_Airlines_Logo.svg/1200px-Malaysia_Airlines_Logo.svg.png', 'premium' => 1.5],
            ['name' => 'Firefly', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Firefly_logo.svg/1280px-Firefly_logo.svg.png', 'premium' => 1.2],
        ];

        // Filters
        $selectedAirlines = $this->request->getQuery('airlines', []);
        $selectedTime = $this->request->getQuery('time', '');
        $flightClass = $this->request->getQuery('flight_class', 'Economy');
        
        $seedString = $origCode . $destCode . $date . json_encode($selectedAirlines) . $selectedTime; 
        $seed = crc32($seedString);
        srand($seed);

        $results = [];
        $numFlights = rand(5, 8);

        for ($i = 0; $i < $numFlights; $i++) {
            $airline = $allAirlines[array_rand($allAirlines)];
            
            // Skip if filtered out
            if (!empty($selectedAirlines) && !in_array($airline['name'], $selectedAirlines)) {
                 continue;
            }

            // Time Generation
            $minHour = 6; $maxHour = 22;
            if ($selectedTime === 'early') { $minHour = 0; $maxHour = 5; }
            elseif ($selectedTime === 'morning') { $minHour = 6; $maxHour = 11; }
            elseif ($selectedTime === 'afternoon') { $minHour = 12; $maxHour = 17; }
            elseif ($selectedTime === 'night') { $minHour = 18; $maxHour = 23; }

            $hour = rand($minHour, $maxHour);
            $minute = rand(0, 11) * 5; // steps of 5 mins
            $departureTime = new \Cake\I18n\DateTime($date . " $hour:$minute:00");
            
            // Price Calculation
            $price = rand((int)$minPrice, (int)$maxPrice);
            $price *= $airline['premium']; // Airline premium
            
            if ($flightClass === 'Business') $price *= 2.5;
            elseif ($flightClass === 'First Class') $price *= 4.0;
            
            // Add some randomness to duration
            $actualDuration = $durationMinutes + rand(-10, 15);

            $flight = $this->Flights->newEmptyEntity();
            $flight->departure_time = $departureTime;
            $flight->base_price = $price;
            $flight->origin_airport = $originAirport;
            $flight->dest_airport = $destAirport;
            $flight->airline_name = $airline['name'];
            $flight->airline_logo = $airline['logo'];
            $flight->duration_text = floor($actualDuration/60) . 'h ' . ($actualDuration%60) . 'm';
            $flight->arrival_time = (clone $departureTime)->modify("+$actualDuration minutes");
            $flight->duration_minutes = $actualDuration;
            
            $results[] = $flight;
        }
        
        // Sorting
        $sort = $this->request->getQuery('sort', 'recommended');
        usort($results, function($a, $b) use ($sort) {
            switch ($sort) {
                case 'cheapest': return $a->base_price <=> $b->base_price;
                case 'fastest': return $a->duration_minutes <=> $b->duration_minutes;
                default: return $a->base_price <=> $b->base_price;
            }
        });

        return $results;
    }

    /**
     * Calculate distance between two coordinates using Haversine formula
     */
    protected function _calculateDistance($lat1, $lon1, $lat2, $lon2) {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
             
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        
        return $earthRadius * $c;
    }
}
