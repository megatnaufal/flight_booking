<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dashboards Controller
 *
 * @property \App\Model\Table\FlightsTable $Flights
 * @property \App\Model\Table\BookingsTable $Bookings
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\PassengersTable $Passengers
 * @property \App\Model\Table\AirportsTable $Airports
 */
class DashboardsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // 1. Fetch Key Statistics
        // We use fetchTable() to get counts from the respective tables
        $stats = [
            'revenue' => 125.4, // This is static; replace with real calculation if needed: $this->fetchTable('Bookings')->find()->sumOf('amount')
            'flights' => $this->fetchTable('Flights')->find()->count(),
            'bookings' => $this->fetchTable('Bookings')->find()->count(),
            'users' => $this->fetchTable('Users')->find()->count(),
        ];

        // 2. Chart Data (Mock Data)
        $revenueLabels = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'];
        $revenueData = [12000, 15000, 11000, 19000, 22000, 25400];

        // 3. Fetch Recent Bookings
        // Contains 'Passengers' and 'Flights' so we can show names and flight numbers
        $bookings = $this->fetchTable('Bookings')->find()
            ->contain(['Passengers', 'Flights'])
            ->limit(10)
            ->order(['Bookings.id' => 'ASC']) // Show oldest first
            ->all();

        // 4. Fetch Recent Flights
        // Contains 'OriginAirports' and 'DestAirports' to display airport codes
        $flights = $this->fetchTable('Flights')->find()
            ->contain(['OriginAirports', 'DestAirports'])
            ->limit(10)
            ->order(['Flights.id' => 'ASC'])
            ->all();

        // 5. Fetch Recent Passengers
        // Contains 'Users' to link to the user account if it exists
        $passengers = $this->fetchTable('Passengers')->find()
            ->contain(['Users'])
            ->limit(10)
            ->order(['Passengers.id' => 'ASC'])
            ->all();

        // 6. Fetch Recent Users
        $users = $this->fetchTable('Users')->find()
            ->limit(10)
            ->order(['Users.id' => 'ASC'])
            ->all();

        // 7. Pass all variables to the View
        $this->set(compact('stats', 'revenueLabels', 'revenueData', 'bookings', 'flights', 'passengers', 'users'));
    }

    /**
     * Admin method - redirects to index
     *
     * @return \Cake\Http\Response|null Redirects to index
     */
    public function admin()
    {
        return $this->redirect(['action' => 'index']);
    }
}