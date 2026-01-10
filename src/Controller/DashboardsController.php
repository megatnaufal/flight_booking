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
        return $this->redirect(['action' => 'admin']);
    }

    public function admin()
    {
        // 1. General Statistics
        // Combining real DB counts with mock revenue data
        $stats = [
            'flights' => $this->fetchTable('Flights')->find()->count(),
            'bookings' => $this->fetchTable('Bookings')->find()->count(),
            'users' => $this->fetchTable('Users')->find()->count(),
            'passengers' => $this->fetchTable('Passengers')->find()->count(),
            'airports' => $this->fetchTable('Airports')->find()->count(),
            'revenue' => 125400.50 // New field from test3 (Mock)
        ];

        // 2. Mock Revenue Data for the Line Chart (MYR) - from test3
        $revenueData = [12000, 15000, 11000, 19000, 22000, 25400];
        $revenueLabels = ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'];

        // 3. Mock Recent Mission Logs for the Table - from test3
        $recentBookings = [
            ['id' => 'MY-101', 'user' => 'Ahmad R.', 'route' => 'KUL -> KCH', 'status' => 'Paid', 'amount' => 'RM 245'],
            ['id' => 'MY-102', 'user' => 'Siti A.', 'route' => 'PEN -> JHB', 'status' => 'Pending', 'amount' => 'RM 120'],
            ['id' => 'MY-103', 'user' => 'Tan K.', 'route' => 'BKI -> TWU', 'status' => 'Paid', 'amount' => 'RM 95'],
            ['id' => 'MY-104', 'user' => 'Maniam V.', 'route' => 'SZB -> LGK', 'status' => 'Paid', 'amount' => 'RM 180'],
        ];

        $this->set(compact('stats', 'revenueData', 'revenueLabels', 'recentBookings'));
    }

    public function user()
    {
        // Placeholder for user specific data
        $this->set('title', 'My Dashboard');
    }
}
