<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 * @property \App\Model\Table\FlightsTable $Flights
 * @property \App\Model\Table\UsersTable $Users
 */
class ReportsController extends AppController
{
    /**
     * Index method - Generates a Printable Report
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // Fetch Data for Report
        $bookings = $this->fetchTable('Bookings')->find()
            ->contain(['Passengers', 'Flights'])
            ->order(['Bookings.id' => 'DESC'])
            ->limit(50) // Limit to last 50 for the repost
            ->all();

        $totalRevenue = 125.40; // Static mock, or calculate: $this->fetchTable('Bookings')->find()->sumOf('amount');
        $totalFlights = $this->fetchTable('Flights')->find()->count();
        $totalPassengers = $this->fetchTable('Passengers')->find()->count();
        $totalUsers = $this->fetchTable('Users')->find()->count();

        $generatedDate = date('d M Y, H:i A');

        $this->set(compact('bookings', 'totalRevenue', 'totalFlights', 'totalPassengers', 'totalUsers', 'generatedDate'));
    }
}
