<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class RemoveUniqueConstraintFromPassengersUserId extends BaseMigration
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
        $table->removeIndexByName('user_id'); // Removing the unique index
        $table->addIndex('user_id', ['unique' => false]); // Adding back as normal index
        $table->update();
    }
}
