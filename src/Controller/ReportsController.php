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

        // Calculate Monthly Revenue (Same logic as Dashboard)
        // Revenue = (base_price + tax_per_pax) * passenger_count for each booking
        $monthlyRevenue = (function() {
            $bookings = $this->fetchTable('Bookings')->find()
                ->contain(['Flights', 'BookingPassengers'])
                ->where([
                    'Bookings.booking_date >=' => date('Y-m-01'),
                    'Bookings.booking_date <=' => date('Y-m-t'),
                    'OR' => [
                        ['Bookings.ticket_status' => 'Confirmed'],
                        ['Bookings.ticket_status' => 'Paid']
                    ]
                ])
                ->all();
            
            $total = 0;
            $taxPerPax = 45.00; // Tax per passenger
            foreach ($bookings as $booking) {
                if ($booking->flight && $booking->flight->base_price) {
                    // Count passengers: booking_passengers or at least 1 (lead passenger)
                    $passengerCount = count($booking->booking_passengers ?? []);
                    if ($passengerCount === 0 && $booking->passenger_id) {
                        $passengerCount = 1; // At least the lead passenger
                    }
                    $total += ($booking->flight->base_price + $taxPerPax) * $passengerCount;
                }
            }
            return $total;
        })();

        // Calculate other stats dynamically
        $totalFlights = $this->fetchTable('Flights')->find()->count();
        $totalPassengers = $this->fetchTable('Passengers')->find()->count();
        $totalUsers = $this->fetchTable('Users')->find()->count();
        $totalBookingsCount = $this->fetchTable('Bookings')->find()->count(); // Total all-time bookings

        $generatedDate = date('d M Y, H:i A');

        $this->set(compact('bookings', 'monthlyRevenue', 'totalFlights', 'totalPassengers', 'totalUsers', 'generatedDate', 'totalBookingsCount'));
    }
}
