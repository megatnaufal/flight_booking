<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LuggagesFixture
 */
class LuggagesFixture extends TestFixture
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
                'booking_id' => 1,
                'weight_kg' => 1.5,
                'luggage_type' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
