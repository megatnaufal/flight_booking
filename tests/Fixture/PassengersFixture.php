<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PassengersFixture
 */
class PassengersFixture extends TestFixture
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
                'user_id' => 1,
                'full_name' => 'Lorem ipsum dolor sit amet',
                'passport_number' => 'Lorem ipsum dolor sit amet',
                'phone_number' => 'Lorem ipsum dolor ',
                'passport_photo' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
