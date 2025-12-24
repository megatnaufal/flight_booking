<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FlightsFixture
 */
class FlightsFixture extends TestFixture
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
                'flight_number' => 'Lorem ipsum dolor ',
                'origin_airport_id' => 1,
                'dest_airport_id' => 1,
                'departure_time' => '2025-12-24 15:12:19',
                'base_price' => 1.5,
            ],
        ];
        parent::init();
    }
}
