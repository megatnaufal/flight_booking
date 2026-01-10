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
    // 1. General Statistics (Including Total Revenue)
    $stats = [
        'flights' => 1250,
        'bookings' => 450,
        'passengers' => 890,
        'users' => 120,
        'airports' => 15,
        'revenue' => 125400.50 // New field
    ];

    // 2. Mock Revenue Data for the Line Chart (MYR)
    $revenueData = [12000, 15000, 11000, 19000, 22000, 25400];
    $revenueLabels = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'];

    // 3. Mock Recent Mission Logs for the Table
    $recentBookings = [
        ['id' => 'MY-101', 'user' => 'Ahmad R.', 'route' => 'KUL -> KCH', 'status' => 'Paid', 'amount' => 'RM 245'],
        ['id' => 'MY-102', 'user' => 'Siti A.', 'route' => 'PEN -> JHB', 'status' => 'Pending', 'amount' => 'RM 120'],
        ['id' => 'MY-103', 'user' => 'Tan K.', 'route' => 'BKI -> TWU', 'status' => 'Paid', 'amount' => 'RM 95'],
        ['id' => 'MY-104', 'user' => 'Maniam V.', 'route' => 'SZB -> LGK', 'status' => 'Paid', 'amount' => 'RM 180'],
    ];

    $this->set(compact('stats', 'revenueData', 'revenueLabels', 'recentBookings'));
    }
}
