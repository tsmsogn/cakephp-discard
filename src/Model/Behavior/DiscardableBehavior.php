<?php
namespace Discard\Model\Behavior;

use Cake\Datasource\EntityInterface;
use Cake\I18n\Time;
use Cake\ORM\Behavior;
use Cake\ORM\Query;

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
        'field' => 'deleted_at'
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
                [$this->_table->getAlias() . '.' . $this->_getFieldExpression() . ' IS NOT' => null]
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
                [$this->_table->getAlias() . '.' . $this->_getFieldExpression() . ' IS' => null]
            );
    }

    /**
     * @param EntityInterface $entity
     * @return bool
     */
    public function isDiscarded(EntityInterface $entity)
    {
        return (bool)$entity->{$this->_getFieldExpression()};
    }

    /**
     * @param EntityInterface $entity
     * @return bool
     */
    public function isUndiscarded(EntityInterface $entity)
    {
        return !$this->isDiscarded($entity);
    }

    /**
     * @param EntityInterface $entity
     * @return bool|EntityInterface|false|mixed
     */
    public function discard(EntityInterface $entity)
    {
        if ($this->isDiscarded($entity)) {
            return;
        }

        $entity->set($this->_getFieldExpression(), $this->_timestamp());
        return $this->_table->save($entity);
    }

    /**
     * @param EntityInterface $entity
     * @return bool|EntityInterface|false|mixed|void
     */
    public function undiscard(EntityInterface $entity)
    {
        if ($this->isUndiscarded($entity)) {
            return;
        }

        $entity->set($this->_getFieldExpression(), null);
        return $this->_table->save($entity);
    }

    /**
     * @return Time
     */
    protected function _timestamp()
    {
        return new Time();
    }

    /**
     * @return mixed
     */
    protected function _getFieldExpression()
    {
        return $this->getConfig('field');
    }
}
