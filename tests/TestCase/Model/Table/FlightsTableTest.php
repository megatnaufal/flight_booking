<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FlightsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FlightsTable Test Case
 */
class FlightsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FlightsTable
     */
    protected $Flights;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Flights',
        'app.OriginAirports',
        'app.DestAirports',
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
        $config = $this->getTableLocator()->exists('Flights') ? [] : ['className' => FlightsTable::class];
        $this->Flights = $this->getTableLocator()->get('Flights', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Flights);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\FlightsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @link \App\Model\Table\FlightsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
