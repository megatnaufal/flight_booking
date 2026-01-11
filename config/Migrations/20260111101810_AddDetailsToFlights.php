<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddDetailsToFlights extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     *
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('flights');
        $table->addColumn('airline_name', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('arrival_time', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
