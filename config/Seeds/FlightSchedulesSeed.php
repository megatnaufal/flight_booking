<?php
declare(strict_types=1);

use Migrations\BaseSeed;

/**
 * FlightSchedules seed.
 * 
 * Generates realistic Malaysian domestic flight schedules for the next 5 days.
 */
class FlightSchedulesSeed extends BaseSeed
{
    /**
     * Run Method.
     *
     * @return void
     */
    public function run(): void
    {
        $flights = $this->table('flights');
        
        // Delete flight schedules that don't have any bookings
        // This preserves flights with existing bookings for record integrity
        $result = $this->execute('DELETE FROM flights WHERE id NOT IN (SELECT DISTINCT flight_id FROM bookings WHERE flight_id IS NOT NULL)');
        echo "Cleared flight schedules without bookings.\n";
        
        // Get airport IDs from database
        $airports = $this->fetchAll('SELECT id, airport_code FROM airports');
        $airportMap = [];
        foreach ($airports as $airport) {
            $airportMap[$airport['airport_code']] = $airport['id'];
        }
        
        // If airports don't exist, skip seeding
        if (empty($airportMap)) {
            echo "No airports found in database. Please seed airports first.\n";
            return;
        }
        
        // Airline configurations
        $airlines = [
            'AirAsia' => ['code' => 'AK', 'premium' => 1.0],
            'Malaysia Airlines' => ['code' => 'MH', 'premium' => 1.5],
            'Batik Air Malaysia' => ['code' => 'OD', 'premium' => 1.2],
            'Firefly' => ['code' => 'FY', 'premium' => 1.1],
        ];
        
        // Route configurations: [origin, dest, duration_minutes, base_price_economy, airlines]
        $routes = [
            // KUL Hub Routes
            ['KUL', 'PEN', 60, 89, ['AirAsia', 'Malaysia Airlines', 'Firefly']],
            ['KUL', 'LGK', 70, 99, ['AirAsia', 'Malaysia Airlines', 'Firefly']],
            ['KUL', 'JHB', 50, 69, ['AirAsia', 'Firefly']],
            ['KUL', 'BKI', 150, 189, ['AirAsia', 'Malaysia Airlines', 'Batik Air Malaysia']],
            ['KUL', 'KCH', 105, 149, ['AirAsia', 'Malaysia Airlines', 'Batik Air Malaysia']],
            
            // Other popular routes
            ['PEN', 'LGK', 35, 59, ['Firefly']],
            ['PEN', 'JHB', 70, 99, ['AirAsia']],
            ['BKI', 'KCH', 90, 129, ['AirAsia', 'Malaysia Airlines']],
        ];

        // START DYNAMIC ROUTE GENERATION
        // Track covered routes to prevent duplicates (since the loop generates return flights)
        $coveredRoutes = [];
        foreach ($routes as $route) {
            $coveredRoutes[$route[0] . '-' . $route[1]] = true;
            $coveredRoutes[$route[1] . '-' . $route[0]] = true; // The loop generates return legs
        }

        $airportCodes = array_keys($airportMap);
        $availableAirlineNames = array_keys($airlines);

        foreach ($airportCodes as $origin) {
            foreach ($airportCodes as $dest) {
                if ($origin === $dest) {
                    continue;
                }
                
                // If this pair is already covered by hardcoded routes, skip
                if (isset($coveredRoutes[$origin . '-' . $dest])) {
                    continue;
                }

                // Generate dynamic route
                // Random airlines (1 or 2)
                $numAirlinesCount = rand(1, 2);
                $routeAirlinesKeys = array_rand($availableAirlineNames, $numAirlinesCount);
                if (!is_array($routeAirlinesKeys)) {
                    $routeAirlinesKeys = [$routeAirlinesKeys];
                }
                $routeAirlines = [];
                foreach ($routeAirlinesKeys as $k) {
                    $routeAirlines[] = $availableAirlineNames[$k];
                }

                // Random attributes
                // Malaysia domestic flights are usually 45m to 2h 30m (East Malaysia)
                // We'll use a simplified random range
                $duration = rand(45, 150); 
                $basePrice = rand(60, 250); 

                // Add to routes array
                $routes[] = [$origin, $dest, $duration, $basePrice, $routeAirlines];

                // Mark as covered
                $coveredRoutes[$origin . '-' . $dest] = true;
                $coveredRoutes[$dest . '-' . $origin] = true;
            }
        }
        // END DYNAMIC ROUTE GENERATION
        
        // Flight time slots organized by filter periods
        // Each period should have at least 3 flight times
        $timeSlots = [
            'early' => ['00:30', '02:00', '03:30', '05:00', '05:30'],      // Early Flight (00:00 - 06:00)
            'morning' => ['06:00', '07:30', '08:45', '09:30', '10:00', '11:00', '11:30'],  // Morning Flight (06:00 - 12:00)
            'afternoon' => ['12:00', '13:00', '14:30', '15:00', '16:00', '17:00', '17:30'], // Afternoon Flight (12:00 - 18:00)
            'night' => ['18:00', '19:00', '19:30', '20:30', '21:00', '22:00', '23:00']     // Night Flight (18:00 - 24:00)
        ];
        
        $data = [];
        $today = new DateTime();
        
        // Generate flights for next 5 days
        for ($day = 0; $day < 5; $day++) {
            $flightDate = clone $today;
            $flightDate->modify("+{$day} days");
            $dateStr = $flightDate->format('Y-m-d');
            
            foreach ($routes as $route) {
                [$origin, $dest, $duration, $basePrice, $routeAirlines] = $route;
                
                // Skip if airports don't exist
                if (!isset($airportMap[$origin]) || !isset($airportMap[$dest])) {
                    continue;
                }
                
                // Generate flights for each time period to ensure filter coverage
                foreach ($timeSlots as $period => $times) {
                    // Select 3-4 random times from this period
                    $numFlightsInPeriod = min(rand(3, 4), count($times));
                    $selectedTimesKeys = array_rand($times, $numFlightsInPeriod);
                    if (!is_array($selectedTimesKeys)) {
                        $selectedTimesKeys = [$selectedTimesKeys];
                    }
                    $selectedTimes = array_map(fn($k) => $times[$k], $selectedTimesKeys);
                    sort($selectedTimes);
                    
                    // Distribute flights among airlines for this period
                    $airlineIndex = 0;
                    
                    foreach ($selectedTimes as $time) {
                        // Cycle through airlines for variety
                        $airlineName = $routeAirlines[$airlineIndex % count($routeAirlines)];
                        $airline = $airlines[$airlineName];
                        $airlineIndex++;
                        
                        $flightNumber = $airline['code'] . rand(100, 9999);
                        
                        $departureTime = new DateTime("{$dateStr} {$time}");
                        $arrivalTime = clone $departureTime;
                        $arrivalTime->modify("+{$duration} minutes");
                        
                        // Price varies by time of day and day of week
                        $dayOfWeek = (int)$flightDate->format('N');
                        $hour = (int)explode(':', $time)[0];
                        
                        // Peak hours (morning 7-9, evening 17-20) have higher prices
                        $peakMultiplier = 1.0;
                        if (($hour >= 7 && $hour <= 9) || ($hour >= 17 && $hour <= 20)) {
                            $peakMultiplier = 1.3;
                        }
                        
                        // Weekends are slightly more expensive
                        $weekendMultiplier = ($dayOfWeek >= 5) ? 1.15 : 1.0;
                        
                        // Calculate final economy price
                        $economyPrice = round($basePrice * $airline['premium'] * $peakMultiplier * $weekendMultiplier);
                        
                        // Add some randomness (+/- 10%)
                        $economyPrice = round($economyPrice * (rand(90, 110) / 100));
                        
                        // Outbound flight
                        $data[] = [
                            'flight_number' => $flightNumber,
                            'origin_airport_id' => $airportMap[$origin],
                            'dest_airport_id' => $airportMap[$dest],
                            'departure_time' => $departureTime->format('Y-m-d H:i:s'),
                            'arrival_time' => $arrivalTime->format('Y-m-d H:i:s'),
                            'base_price' => $economyPrice,
                            'airline_name' => $airlineName,
                        ];
                        
                        // Return flight (different flight number, offset by 2-4 hours)
                        $returnFlightNumber = $airline['code'] . rand(100, 9999);
                        $returnDeparture = clone $arrivalTime;
                        $returnDeparture->modify("+" . rand(2, 4) . " hours");
                        $returnArrival = clone $returnDeparture;
                        $returnArrival->modify("+{$duration} minutes");
                        
                        $data[] = [
                            'flight_number' => $returnFlightNumber,
                            'origin_airport_id' => $airportMap[$dest],
                            'dest_airport_id' => $airportMap[$origin],
                            'departure_time' => $returnDeparture->format('Y-m-d H:i:s'),
                            'arrival_time' => $returnArrival->format('Y-m-d H:i:s'),
                            'base_price' => $economyPrice,
                            'airline_name' => $airlineName,
                        ];
                    }
                }
            }
        }
        
        if (!empty($data)) {
            $flights->insert($data)->save();
            echo "Inserted " . count($data) . " flight schedules.\n";
        }
    }
}
