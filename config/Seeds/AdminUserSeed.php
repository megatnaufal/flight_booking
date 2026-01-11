<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

/**
 * AdminUser seed.
 */
class AdminUserSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        // Check if admin user already exists
        $usersTable = $this->table('users');
        $exists = $this->fetchRow("SELECT id FROM users WHERE email = 'admin@flyhigh.com'");
        
        if (!$exists) {
            $data = [
                [
                    'username' => 'admin',
                    'email' => 'admin@flyhigh.com',
                    'password' => (new DefaultPasswordHasher())->hash('admin123'),
                    'role' => 'admin',
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s'),
                ]
            ];

            $usersTable->insert($data)->saveData();
        }
    }
}
