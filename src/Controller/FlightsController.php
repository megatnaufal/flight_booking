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

        // Fetch airports for the dropdowns
        $airportsTable = $this->fetchTable('Airports');
        $airports = $airportsTable->find('list', [
            'keyField' => 'id',
            'valueField' => function ($airport) {
                return $airport->city . ' (' . $airport->airport_code . ')';
            }
        ])->all()->toArray();

        // If we have search params, generate random flights
        if ($originAirportId && $destAirportId && $departureDate) {
            $originAirport = $airportsTable->get($originAirportId);
            $destAirport = $airportsTable->get($destAirportId);

            $airlines = [
                ['name' => 'AirAsia', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f5/AirAsia_New_Logo.svg/1200px-AirAsia_New_Logo.svg.png'],
                ['name' => 'Batik Air', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Batik_Air_logo.svg/2560px-Batik_Air_logo.svg.png'],
                ['name' => 'Malaysia Airlines', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Malaysia_Airlines_Logo.svg/1200px-Malaysia_Airlines_Logo.svg.png'],
                ['name' => 'Firefly', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/Firefly_logo.svg/1280px-Firefly_logo.svg.png'],
            ];

            // Get passenger count
            $passengers = (int)$this->request->getQuery('passengers_adult', 1) 
                        + (int)$this->request->getQuery('passengers_child', 0) 
                        + (int)$this->request->getQuery('passengers_infant', 0);
            $flightClass = $this->request->getQuery('flight_class', 'Economy');

            // Create a deterministic seed based on search params
            // This ensures the same "random" flights are generated for the same search query
            $seedString = $originAirportId . $destAirportId . $departureDate;
            $seed = crc32($seedString);
            srand($seed);

            $numFlights = rand(5, 10);
            $results = [];

            for ($i = 0; $i < $numFlights; $i++) {
                $airline = $airlines[array_rand($airlines)];
                
                // Random time
                $hour = rand(6, 22);
                $minute = rand(0, 59);
                $departureTime = new \Cake\I18n\DateTime($departureDate . " $hour:$minute:00");
                
                // Route Data Lookup
                // Format: [OriginCode_DestCode] => ['duration_min' => int, 'price_min' => int, 'price_max' => int]
                $routeData = [
                    'KUL_BKI' => ['duration' => 160, 'min' => 127, 'max' => 300], // 2h 40m
                    'BKI_KUL' => ['duration' => 160, 'min' => 127, 'max' => 300],
                    'KUL_LGK' => ['duration' => 65, 'min' => 71, 'max' => 150], // 1h 05m
                    'LGK_KUL' => ['duration' => 65, 'min' => 71, 'max' => 150],
                    'KUL_PEN' => ['duration' => 60, 'min' => 33, 'max' => 110], // 1h
                    'PEN_KUL' => ['duration' => 60, 'min' => 33, 'max' => 110],
                    'KUL_KCH' => ['duration' => 105, 'min' => 89, 'max' => 200], // 1h 45m
                    'KCH_KUL' => ['duration' => 105, 'min' => 89, 'max' => 200],
                ];

                $routeKey = $originAirport->airport_code . '_' . $destAirport->airport_code;
                $data = $routeData[$routeKey] ?? null;

                // Duration Logic
                if ($data) {
                     // Add small random variation (+- 5 mins)
                     $durationMinutes = $data['duration'] + rand(-5, 5);
                } else {
                     // Fallback for unknown routes
                    $durationMinutes = rand(60, 240);
                }

                
                // Determine if domestic (assuming both in Malaysia if country is missing or same)
                $isDomestic = true; 
                // Simple heuristic: If country is not set, assume domestic. If set, compare.
                if (isset($originAirport->country) && isset($destAirport->country)) {
                    $isDomestic = ($originAirport->country === $destAirport->country);
                }

                // Price Logic
                if ($data) {
                    $minPrice = $data['min'];
                    $maxPrice = $data['max'];
                } else {
                    $minPrice = 50;
                    $maxPrice = 300;
                    if (!$isDomestic) {
                        $minPrice = 200;
                        $maxPrice = 800;
                    }
                }
                
                // Airline Adjustment
                if ($airline['name'] === 'Malaysia Airlines') {
                    $minPrice *= 1.5; // Full service premium
                    $maxPrice *= 1.5;
                }
                
                // Class Adjustment
                if ($flightClass === 'Business') {
                    $minPrice *= 2.5;
                    $maxPrice *= 2.5;
                } elseif ($flightClass === 'First Class') {
                    $minPrice *= 4.0;
                    $maxPrice *= 4.0;
                }

                $flight = $this->Flights->newEmptyEntity();
                $flight->departure_time = $departureTime;
                
                // Base price for 1 person
                $singlePaxPrice = rand((int)$minPrice, (int)$maxPrice) + (rand(0, 99) / 100);
                
                // Set total price based on passenger count (simplified for display)
                // In a real app, you might store single price and calculate total in view
                // Here we store single price as base_price
                $flight->base_price = $singlePaxPrice;
                
                // Attach dynamic properties
                $flight->origin_airport = $originAirport;
                $flight->dest_airport = $destAirport;
                
                // Dynamic properties for view
                $flight->airline_name = $airline['name'];
                $flight->airline_logo = $airline['logo'];
                $flight->duration_text = floor($durationMinutes/60) . 'h ' . ($durationMinutes%60) . 'm';
                
                // Calculate arrival time (clone to avoid modifying departure)
                $flight->arrival_time = (clone $departureTime)->modify("+$durationMinutes minutes");

                // Store raw duration for sorting
                $flight->duration_minutes = $durationMinutes;
                
                $results[] = $flight;
            }
            
            // Sorting Logic
            $sort = $this->request->getQuery('sort', 'recommended');
            
            usort($results, function($a, $b) use ($sort) {
                switch ($sort) {
                    case 'cheapest':
                        return $a->base_price <=> $b->base_price;
                    case 'fastest':
                        return $a->duration_minutes <=> $b->duration_minutes;
                    case 'recommended':
                    default:
                        // Recommended: Balance of price (70%) and duration (30%) normalization could be complex,
                        // for now, let's stick to Price ascending as "Best Value"
                        return $a->base_price <=> $b->base_price;
                }
            });

            $searchResults = $results;
        }
        
        $this->set(compact('searchResults', 'airports'));
    }
}
