<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Pages Controller
 *
 * This controller handles static content and provides data for the custom home page.
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException
     * @throws \Cake\Http\Exception\NotFoundException
     */
    public function display(string ...$path): ?Response
    {

        
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }

        $page = $subpage = null;
        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        /**
         * DATA FOR HOMEPAGE
         */
        if ($page === 'home') {
            // Define the 5 specific destinations with their display labels
            $targetDestinations = [
                'Kuala Lumpur' => ['image' => 'kuala-lumpur.png', 'fromCity' => 'Kuala Lumpur', 'stateName' => 'Kuala Lumpur'],
                'Kuching' => ['image' => 'kuching.png', 'fromCity' => 'Kuching', 'stateName' => 'Sarawak'],
                'Penang' => ['image' => 'penang.png', 'fromCity' => 'George Town', 'stateName' => 'Penang'],
                'Kota Kinabalu' => ['image' => 'kota-kinabalu.png', 'fromCity' => 'Kota Kinabalu', 'stateName' => 'Sabah'],
                'Johor Bahru' => ['image' => 'johor-bahru.png', 'fromCity' => 'Johor Bahru', 'stateName' => 'Johor'],
            ];
            
            // Fetch lowest prices from the database for each destination
            $flightsTable = $this->fetchTable('Flights');
            $airportsTable = $this->fetchTable('Airports');
            
            $recommendations = [];
            foreach ($targetDestinations as $city => $info) {
                // Find the airport(s) for this city
                $destAirport = $airportsTable->find()
                    ->where(['city' => $city])
                    ->first();
                
                if ($destAirport) {
                    // Find the lowest price flight to this destination
                    $lowestFlight = $flightsTable->find()
                        ->contain(['OriginAirports'])
                        ->where(['dest_airport_id' => $destAirport->id])
                        ->orderBy(['base_price' => 'ASC'])
                        ->first();
                    
                    if ($lowestFlight) {
                        $recommendations[] = [
                            'stateName' => $info['stateName'],
                            'price' => number_format((float)$lowestFlight->base_price, 2),
                            'fromCity' => $info['fromCity'],
                            'image' => $info['image'],
                            'airport_id' => $destAirport->id,
                        ];
                    } else {
                        // No flights found, use default price
                        $recommendations[] = [
                            'stateName' => $info['stateName'],
                            'price' => '99.00',
                            'fromCity' => $info['fromCity'],
                            'image' => $info['image'],
                            'airport_id' => $destAirport->id,
                        ];
                    }
                }
            }
            
            // content of PagesController::display()
            $airportsTable = $this->fetchTable('Airports');
            $airports = $airportsTable->find('list', [
                'keyField' => 'id',
                'valueField' => function ($airport) {
                    return $airport->city . ' (' . $airport->airport_code . ')';
                }
            ])->all()->toArray();

            $this->set(compact('recommendations', 'airports'));
        }

        if ($page === 'about') {
            $flightsCount = $this->fetchTable('Flights')->find()->count();
            $bookingsCount = $this->fetchTable('Bookings')->find()->count();
            $airportsCount = $this->fetchTable('Airports')->find()->count();
            
            // Format for display (e.g. 10k+, 2M+ logic could go here, or just raw numbers)
            // For now passing raw counts
            $this->set(compact('flightsCount', 'bookingsCount', 'airportsCount'));
        }

        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }
}