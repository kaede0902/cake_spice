<?php
namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Validator;

class PeopleTable extends Table {
    public function inititalize(array $config) {
        parent::inititalize($config);
        $this->setTable('people');
        $this->setDisplayField('mail');
        $this->setPrimaryKey('id');
    }
    public function findMe(Query $query, array $options) {
        $me = $options['me'];
        return $query
            ->where(['name like' => '%'.$me.'%'])
            ->orWhere(['mail like' => '%'.$me.'%'])
            ->order(['age'=>'asc']);
    }
    public function findAge(Query $query, array $options) {
        return $query
            ->order(['age'=>'asc'])
            ->order(['name'=>'asc']);
    }
    public function validationDefault(Validator $validator) {
        $validator
            ->integer('id')
            ->allowEmpty('id','create');
        $validator
            ->scalar('name')
            ->requirePresence('name', 'create')
            ->notEmpty('name');
        $validator
            ->scalar('mail')
            ->allowEmpty('mail');
        $validator
            ->scalar('age')
            ->requirePresence('age', 'create')
            ->notEmpty('age');

        return $validator;
    }
}
