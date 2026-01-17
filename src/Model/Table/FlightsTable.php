<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Flights Model
 *
 * @property \App\Model\Table\AirportsTable&\Cake\ORM\Association\BelongsTo $OriginAirports
 * @property \App\Model\Table\AirportsTable&\Cake\ORM\Association\BelongsTo $DestAirports
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\HasMany $Bookings
 *
 * @method \App\Model\Entity\Flight newEmptyEntity()
 * @method \App\Model\Entity\Flight newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Flight> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Flight get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Flight findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Flight patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Flight> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Flight|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Flight saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Flight>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flight>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flight>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flight> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flight>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flight>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Flight>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Flight> deleteManyOrFail(iterable $entities, array $options = [])
 */
class FlightsTable extends Table
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

        $this->setTable('flights');
        $this->setDisplayField('flight_number');
        $this->setPrimaryKey('id');

        $this->belongsTo('OriginAirports', [
            'foreignKey' => 'origin_airport_id',
            'className' => 'Airports',
        ]);
        $this->belongsTo('DestAirports', [
            'foreignKey' => 'dest_airport_id',
            'className' => 'Airports',
        ]);
        $this->hasMany('Bookings', [
            'foreignKey' => 'flight_id',
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
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
            ->scalar('flight_number')
            ->maxLength('flight_number', 20)
            ->requirePresence('flight_number', 'create')
            ->notEmptyString('flight_number');

        $validator
            ->integer('origin_airport_id')
            ->allowEmptyString('origin_airport_id');

        $validator
            ->integer('dest_airport_id')
            ->allowEmptyString('dest_airport_id');

        $validator
            ->dateTime('departure_time')
            ->allowEmptyDateTime('departure_time');

        $validator
            ->decimal('base_price')
            ->allowEmptyString('base_price');

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
        $rules->add($rules->existsIn(['origin_airport_id'], 'OriginAirports'), ['errorField' => 'origin_airport_id']);
        $rules->add($rules->existsIn(['dest_airport_id'], 'DestAirports'), ['errorField' => 'dest_airport_id']);

        return $rules;
    }
}
