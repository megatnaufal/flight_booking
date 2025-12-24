<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PassengersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PassengersTable Test Case
 */
class PassengersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PassengersTable
     */
    protected $Passengers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Passengers',
        'app.Users',
        'app.Bookings',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Passengers') ? [] : ['className' => PassengersTable::class];
        $this->Passengers = $this->getTableLocator()->get('Passengers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Passengers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\PassengersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\PassengersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
