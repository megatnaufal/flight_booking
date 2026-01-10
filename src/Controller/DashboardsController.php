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

        
        $flightOptions = ['limit' => 200];
        
        $stats = [
            'flights' => $this->fetchTable('Flights')->find('all', $flightOptions)->count(),
            'bookings' => $this->fetchTable('Bookings')->find()->count(),
            'users' => $this->fetchTable('Users')->find()->count(),
            'passengers' => $this->fetchTable('Passengers')->find()->count(),
            'airports' => $this->fetchTable('Airports')->find()->count(),
        ];

        $this->set(compact('stats'));
    }

    /**
     * Admin Settings method
     */
    public function settings()
    {
        // In a real app, we'd fetch config from DB
        // For now, just render the view
    }
}
