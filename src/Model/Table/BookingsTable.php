<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Bookings Model
 *
 * @property \App\Model\Table\PassengersTable&\Cake\ORM\Association\BelongsTo $Passengers
 * @property \App\Model\Table\FlightsTable&\Cake\ORM\Association\BelongsTo $Flights
 * @property \App\Model\Table\LuggagesTable&\Cake\ORM\Association\HasMany $Luggages
 *
 * @method \App\Model\Entity\Booking newEmptyEntity()
 * @method \App\Model\Entity\Booking newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Booking> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Booking get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Booking findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Booking patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Booking> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Booking|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Booking saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Booking>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Booking>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Booking>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Booking> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Booking>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Booking>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Booking>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Booking> deleteManyOrFail(iterable $entities, array $options = [])
 */
class BookingsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('bookings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Passengers', [
            'foreignKey' => 'passenger_id',
        ]);
        $this->belongsTo('Flights', [
            'foreignKey' => 'flight_id',
        ]);
        // Association for all passengers in the booking
        $this->hasMany('BookingPassengers', [
            'className' => 'Passengers',
            'foreignKey' => 'booking_id',
            'dependent' => true,
        ]);
    }

    public function afterDelete(\Cake\Event\EventInterface $event, \Cake\Datasource\EntityInterface $entity, \ArrayObject $options): void
    {
        $tableLocator = \Cake\ORM\TableRegistry::getTableLocator();

        // 1. Delete the associated Flight
        if (!empty($entity->flight_id)) {
            $flightsTable = $tableLocator->get('Flights');
            $flight = $flightsTable->find()->where(['id' => $entity->flight_id])->first();
            if ($flight) {
                // Prevent infinite recursion if flight deletes booking
                $flightsTable->delete($flight, ['atomic' => false]);
            }
        }

        // 2. Delete the associated Passenger
        if (!empty($entity->passenger_id)) {
            $passengersTable = $tableLocator->get('Passengers');
            $passenger = $passengersTable->find()->where(['id' => $entity->passenger_id])->first();
            if ($passenger) {
                 $passengersTable->delete($passenger, ['atomic' => false]);
            }
        }
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('passenger_id')
            ->allowEmptyString('passenger_id');

        $validator
            ->integer('flight_id')
            ->allowEmptyString('flight_id');

        $validator
            ->date('booking_date')
            ->allowEmptyDate('booking_date');

        $validator
            ->scalar('seat_number')
            ->maxLength('seat_number', 10)
            ->allowEmptyString('seat_number');

        $validator
            ->scalar('ticket_status')
            ->maxLength('ticket_status', 50)
            ->allowEmptyString('ticket_status');

        $validator
            ->scalar('payment_method')
            ->maxLength('payment_method', 255)
            ->allowEmptyString('payment_method');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['passenger_id'], 'Passengers'), ['errorField' => 'passenger_id']);
        $rules->add($rules->existsIn(['flight_id'], 'Flights'), ['errorField' => 'flight_id']);

        return $rules;
    }
}
