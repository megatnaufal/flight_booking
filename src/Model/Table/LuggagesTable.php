<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Luggages Model
 *
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\BelongsTo $Bookings
 *
 * @method \App\Model\Entity\Luggage newEmptyEntity()
 * @method \App\Model\Entity\Luggage newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Luggage> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Luggage get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Luggage findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Luggage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Luggage> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Luggage|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Luggage saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Luggage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Luggage>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Luggage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Luggage> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Luggage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Luggage>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Luggage>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Luggage> deleteManyOrFail(iterable $entities, array $options = [])
 */
class LuggagesTable extends Table
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

        $this->setTable('luggages');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Bookings', [
            'foreignKey' => 'booking_id',
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
            ->integer('booking_id')
            ->allowEmptyString('booking_id');

        $validator
            ->decimal('weight_kg')
            ->allowEmptyString('weight_kg');

        $validator
            ->scalar('luggage_type')
            ->maxLength('luggage_type', 50)
            ->allowEmptyString('luggage_type');

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
        $rules->add($rules->existsIn(['booking_id'], 'Bookings'), ['errorField' => 'booking_id']);

        return $rules;
    }
}
