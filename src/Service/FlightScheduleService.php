<?php
declare(strict_types=1);

namespace App\Service;

use Cake\ORM\TableRegistry;
use Cake\Cache\Cache;
use DateTime;

/**
 * FlightScheduleService
 * 
 * Automatically generates and maintains flight schedules for the next 5 days.
 * Can be called from middleware, commands, or controllers.
 */
class FlightScheduleService
{
    /**
     * Check if flights need regeneration and regenerate if necessary.
     * Uses cache to prevent checking on every request.
     *
     * @return bool Whether flights were regenerated
     */
    public function checkAndRegenerate(): bool
    {
        // Use cache to limit checks to once per hour
        $cacheKey = 'flight_schedule_last_check';
        $lastCheck = Cache::read($cacheKey, 'default');
        
        if ($lastCheck && (time() - $lastCheck) < 3600) {
            // Checked within the last hour, skip
            return false;
        }
        
        // Update cache timestamp
        Cache::write($cacheKey, time(), 'default');
        
        // Check if we need to regenerate
        if ($this->needsRegeneration()) {
            $this->regenerateFlights();
            return true;
        }
        
        return false;
    }
    
    /**
     * Check if flight schedules need regeneration.
     * Returns true if there are no flights for tomorrow onwards.
     *
     * @return bool
     */
    public function needsRegeneration(): bool
    {
        $flightsTable = TableRegistry::getTableLocator()->get('Flights');
        
        $tomorrow = (new DateTime())->modify('+1 day')->format('Y-m-d 00:00:00');
        $fiveDaysFromNow = (new DateTime())->modify('+5 days')->format('Y-m-d 23:59:59');
        
        // Count upcoming flights (not including today to allow for timezone differences)
        $upcomingFlightsCount = $flightsTable->find()
            ->where([
                'departure_time >=' => $tomorrow,
                'departure_time <=' => $fiveDaysFromNow
            ])
            ->count();
        
        // If there are less than 100 upcoming flights, regenerate
        // (A healthy schedule should have hundreds of flights)
        return $upcomingFlightsCount < 100;
    }
    
    /**
     * Force regenerate all flight schedules for the next 5 days.
     * Preserves flights with existing bookings.
     *
     * @return int Number of flights generated
     */
    public function regenerateFlights(): int
    {
        $flightsTable = TableRegistry::getTableLocator()->get('Flights');
        $airportsTable = TableRegistry::getTableLocator()->get('Airports');
        $bookingsTable = TableRegistry::getTableLocator()->get('Bookings');
        
        // Get all flight IDs that have bookings
        $bookedFlightIds = $bookingsTable->find()
            ->select(['flight_id'])
            ->where(['flight_id IS NOT' => null])
            ->distinct()
            ->all()
            ->extract('flight_id')
            ->toArray();
        
        // Delete flights without bookings
        if (!empty($bookedFlightIds)) {
            $flightsTable->deleteAll([
                'id NOT IN' => $bookedFlightIds
            ]);
        } else {
            $flightsTable->deleteAll([]);
        }
        
        // Get airport IDs
        $airports = $airportsTable->find()
            ->select(['id', 'airport_code'])
            ->all();
        
        $airportMap = [];
        foreach ($airports as $airport) {
            $airportMap[$airport->airport_code] = $airport->id;
        }
        
        if (empty($airportMap)) {
            return 0;
        }
        
        // Airline configurations
        $airlines = [
            'AirAsia' => ['code' => 'AK', 'premium' => 1.0],
            'Malaysia Airlines' => ['code' => 'MH', 'premium' => 1.5],
            'Batik Air Malaysia' => ['code' => 'OD', 'premium' => 1.2],
            'Firefly' => ['code' => 'FY', 'premium' => 1.1],
        ];
        
        // Route configurations
        $routes = [
            ['KUL', 'PEN', 60, 89, ['AirAsia', 'Malaysia Airlines', 'Firefly']],
            ['KUL', 'LGK', 70, 99, ['AirAsia', 'Malaysia Airlines', 'Firefly']],
            ['KUL', 'JHB', 50, 69, ['AirAsia', 'Firefly']],
            ['KUL', 'BKI', 150, 189, ['AirAsia', 'Malaysia Airlines', 'Batik Air Malaysia']],
            ['KUL', 'KCH', 105, 149, ['AirAsia', 'Malaysia Airlines', 'Batik Air Malaysia']],
            ['PEN', 'LGK', 35, 59, ['Firefly']],
            ['PEN', 'JHB', 70, 99, ['AirAsia']],
            ['BKI', 'KCH', 90, 129, ['AirAsia', 'Malaysia Airlines']],
        ];
        
        // Time slots for each filter period
        $timeSlots = [
            'early' => ['00:30', '02:00', '03:30', '05:00', '05:30'],
            'morning' => ['06:00', '07:30', '08:45', '09:30', '10:00', '11:00', '11:30'],
            'afternoon' => ['12:00', '13:00', '14:30', '15:00', '16:00', '17:00', '17:30'],
            'night' => ['18:00', '19:00', '19:30', '20:30', '21:00', '22:00', '23:00']
        ];
        
        $flightsData = [];
        $today = new DateTime();
        
        // Generate flights for next 5 days
        for ($day = 0; $day < 5; $day++) {
            $flightDate = clone $today;
            $flightDate->modify("+{$day} days");
            $dateStr = $flightDate->format('Y-m-d');
            
            foreach ($routes as $route) {
                [$origin, $dest, $duration, $basePrice, $routeAirlines] = $route;
                
                if (!isset($airportMap[$origin]) || !isset($airportMap[$dest])) {
                    continue;
                }
                
                foreach ($timeSlots as $period => $times) {
                    $numFlightsInPeriod = min(rand(3, 4), count($times));
                    $selectedTimesKeys = array_rand($times, $numFlightsInPeriod);
                    if (!is_array($selectedTimesKeys)) {
                        $selectedTimesKeys = [$selectedTimesKeys];
                    }
                    $selectedTimes = array_map(fn($k) => $times[$k], $selectedTimesKeys);
                    sort($selectedTimes);
                    
                    $airlineIndex = 0;
                    
                    foreach ($selectedTimes as $time) {
                        $airlineName = $routeAirlines[$airlineIndex % count($routeAirlines)];
                        $airline = $airlines[$airlineName];
                        $airlineIndex++;
                        
                        $flightNumber = $airline['code'] . rand(100, 9999);
                        
                        $departureTime = new DateTime("{$dateStr} {$time}");
                        $arrivalTime = clone $departureTime;
                        $arrivalTime->modify("+{$duration} minutes");
                        
                        $dayOfWeek = (int)$flightDate->format('N');
                        $hour = (int)explode(':', $time)[0];
                        
                        $peakMultiplier = 1.0;
                        if (($hour >= 7 && $hour <= 9) || ($hour >= 17 && $hour <= 20)) {
                            $peakMultiplier = 1.3;
                        }
                        
                        $weekendMultiplier = ($dayOfWeek >= 5) ? 1.15 : 1.0;
                        $economyPrice = round($basePrice * $airline['premium'] * $peakMultiplier * $weekendMultiplier);
                        $economyPrice = round($economyPrice * (rand(90, 110) / 100));
                        
                        // Outbound flight
                        $flightsData[] = [
                            'flight_number' => $flightNumber,
                            'origin_airport_id' => $airportMap[$origin],
                            'dest_airport_id' => $airportMap[$dest],
                            'departure_time' => $departureTime->format('Y-m-d H:i:s'),
                            'arrival_time' => $arrivalTime->format('Y-m-d H:i:s'),
                            'base_price' => $economyPrice,
                            'airline_name' => $airlineName,
                        ];
                        
                        // Return flight
                        $returnFlightNumber = $airline['code'] . rand(100, 9999);
                        $returnDeparture = clone $arrivalTime;
                        $returnDeparture->modify("+" . rand(2, 4) . " hours");
                        $returnArrival = clone $returnDeparture;
                        $returnArrival->modify("+{$duration} minutes");
                        
                        $flightsData[] = [
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
        
        // Bulk insert all flights
        if (!empty($flightsData)) {
            $flights = $flightsTable->newEntities($flightsData);
            $flightsTable->saveMany($flights);
        }
        
        return count($flightsData);
    }
}
