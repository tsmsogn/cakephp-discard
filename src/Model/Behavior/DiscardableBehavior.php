<?php
namespace Discard\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\I18n\Time;
use Cake\ORM\Behavior;
use Cake\ORM\Query;
use Cake\Utility\Hash;

/**
 * Discardable behavior
 */
class DiscardableBehavior extends Behavior
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'field' => 'deleted',
    ];

    public function initialize(array $config)
    {
        if (isset($config['field'])) {
            $this->setConfig('field', $config['field'], false);
        }
    }

    /**
     * @param Query $query
     * @param array $options
     * @return $this
     */
    public function findDiscarded(Query $query, array $options)
    {
        return $query
            ->where(
                [$this->_table->getAlias() . '.' . $this->getConfig('field') . ' IS NOT' => null]
            );
    }

    /**
     * @param Query $query
     * @param array $options
     * @return $this
     */
    public function findKept(Query $query, array $options)
    {
        return $query
            ->where(
                [$this->_table->getAlias() . '.' . $this->getConfig('field') . ' IS' => null]
            );
    }

    /**
     * @param $conditions
     * @return bool
     */
    public function isDiscarded($conditions)
    {
        $conditions = Hash::merge(
            $conditions, [$this->_table->getAlias() . '.' . $this->getConfig('field') . ' IS NOT' => null]
        );
        return $this->_table->exists($conditions);
    }

    /**
     * @param $conditions
     * @return bool
     */
    public function isUndiscarded($conditions)
    {
        $conditions = Hash::merge(
            $conditions, [$this->_table->getAlias() . '.' . $this->getConfig('field') . ' IS' => null]
        );
        return $this->_table->exists($conditions);
    }

    /**
     * @param EntityInterface $entity
     * @return bool|EntityInterface|false|mixed
     */
    public function discard(EntityInterface $entity)
    {
        $entity->set($this->getConfig('field'), $this->_timestamp());
        return $this->_table->save($entity);
    }

    /**
     * @param EntityInterface $entity
     * @return bool|EntityInterface|false|mixed|void
     */
    public function undiscard(EntityInterface $entity)
    {
        $entity->set($this->getConfig('field'), null);
        return $this->_table->save($entity);
    }

    /**
     * @return Time
     */
    protected function _timestamp()
    {
        return new Time();
    }
}
