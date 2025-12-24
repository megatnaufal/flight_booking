<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BookingsFixture
 */
class BookingsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'passenger_id' => 1,
                'flight_id' => 1,
                'booking_date' => '2025-12-24',
                'seat_number' => 'Lorem ip',
                'ticket_status' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
