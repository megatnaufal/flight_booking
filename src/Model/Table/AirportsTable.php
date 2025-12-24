<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Airports Model
 *
 * @method \App\Model\Entity\Airport newEmptyEntity()
 * @method \App\Model\Entity\Airport newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Airport> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Airport get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Airport findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Airport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Airport> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Airport|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Airport saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Airport>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Airport>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Airport>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Airport> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Airport>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Airport>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Airport>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Airport> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AirportsTable extends Table
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

        $this->setTable('airports');
        $this->setDisplayField('airport_code');
        $this->setPrimaryKey('id');
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
            ->scalar('airport_code')
            ->maxLength('airport_code', 10)
            ->requirePresence('airport_code', 'create')
            ->notEmptyString('airport_code')
            ->add('airport_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('airport_name')
            ->maxLength('airport_name', 255)
            ->requirePresence('airport_name', 'create')
            ->notEmptyString('airport_name');

        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->allowEmptyString('city');

        $validator
            ->scalar('country')
            ->maxLength('country', 100)
            ->allowEmptyString('country');

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
        $rules->add($rules->isUnique(['airport_code']), ['errorField' => 'airport_code']);

        return $rules;
    }
}
