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
            ->contain(['OriginAirports', 'DestAirports'])
            ->order(['Flights.id' => 'ASC']);
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

            $searchResults = $this->_searchFlights($originAirport, $destAirport, $departureDate);
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

        $searchResults = $this->_searchFlights($originAirport, $destAirport, $departureDate);
        
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
     * Search flights from database
     * 
     * @param \App\Model\Entity\Airport $originAirport Origin airport entity
     * @param \App\Model\Entity\Airport $destAirport Destination airport entity
     * @param string $date Departure date in Y-m-d format
     * @return array Array of Flight entities
     */
    protected function _searchFlights($originAirport, $destAirport, $date)
    {
        // Filters from query params
        $selectedAirlines = $this->request->getQuery('airlines', []);
        $selectedTime = $this->request->getQuery('time', '');
        $flightClass = $this->request->getQuery('flight_class', 'Economy');
        $sort = $this->request->getQuery('sort', 'recommended');
        
        // Build query
        $query = $this->Flights->find()
            ->contain(['OriginAirports', 'DestAirports'])
            ->where([
                'Flights.origin_airport_id' => $originAirport->id,
                'Flights.dest_airport_id' => $destAirport->id,
                'DATE(Flights.departure_time)' => $date,
            ]);
        
        // Filter by airlines
        if (!empty($selectedAirlines)) {
            $query->where(['Flights.airline_name IN' => $selectedAirlines]);
        }
        
        // Filter by departure time
        if (!empty($selectedTime)) {
            switch ($selectedTime) {
                case 'early':
                    $query->where(['HOUR(Flights.departure_time) >=' => 0])
                          ->where(['HOUR(Flights.departure_time) <' => 6]);
                    break;
                case 'morning':
                    $query->where(['HOUR(Flights.departure_time) >=' => 6])
                          ->where(['HOUR(Flights.departure_time) <' => 12]);
                    break;
                case 'afternoon':
                    $query->where(['HOUR(Flights.departure_time) >=' => 12])
                          ->where(['HOUR(Flights.departure_time) <' => 18]);
                    break;
                case 'night':
                    $query->where(['HOUR(Flights.departure_time) >=' => 18])
                          ->where(['HOUR(Flights.departure_time) <' => 24]);
                    break;
            }
        }
        
        // Sorting
        switch ($sort) {
            case 'cheapest':
                $query->orderAsc('Flights.base_price');
                break;
            case 'fastest':
                $query->orderAsc('TIMESTAMPDIFF(MINUTE, Flights.departure_time, Flights.arrival_time)');
                break;
            default: // recommended - sort by price
                $query->orderAsc('Flights.base_price');
                break;
        }
        
        $results = $query->all()->toArray();
        
        // Apply class pricing
        if ($flightClass === 'Business') {
            foreach ($results as $flight) {
                $flight->base_price = round((float)$flight->base_price * 2.5, 2);
            }
        }
        
        return $results;
    }
}
