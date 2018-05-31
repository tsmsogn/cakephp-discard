<?php
namespace Discard\Test\TestApp\Model\Table;

use Cake\ORM\Table;

/**
 * @mixin \Discard\Model\Behavior\DiscardableBehavior
 */
class ProductsTable extends Table
{
    public function initialize(array $config)
    {
        $this->setPrimaryKey('id');

        $this->addBehavior('Discard.Discardable');
    }
}