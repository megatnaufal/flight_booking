<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Passengers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\BookingsTable&\Cake\ORM\Association\HasMany $Bookings
 *
 * @method \App\Model\Entity\Passenger newEmptyEntity()
 * @method \App\Model\Entity\Passenger newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Passenger> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Passenger get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Passenger findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Passenger patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Passenger> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Passenger|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Passenger saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Passenger>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Passenger>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Passenger>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Passenger> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Passenger>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Passenger>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Passenger>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Passenger> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PassengersTable extends Table
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

        $this->setTable('passengers');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
        ]);
        $this->hasMany('Bookings', [
            'foreignKey' => 'passenger_id',
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
            ->integer('user_id')
            ->allowEmptyString('user_id')
            ->add('user_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 255)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

        $validator
            ->scalar('passport_number')
            ->maxLength('passport_number', 50)
            ->allowEmptyString('passport_number');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 20)
            ->allowEmptyString('phone_number');

        $validator
            ->allowEmptyString('passport_photo');

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
        $rules->add($rules->isUnique(['user_id'], ['allowMultipleNulls' => true]), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
