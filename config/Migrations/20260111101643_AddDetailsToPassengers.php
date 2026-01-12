<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddDetailsToPassengers extends BaseMigration
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
        $table = $this->table('passengers');
        $table->addColumn('booking_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => true,
        ]);
        $table->addColumn('email', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => true,
        ]);
        $table->addColumn('dob', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('type', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->addIndex([
            'booking_id',
        ]);
        $table->update();
    }
}
