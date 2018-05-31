<?php
namespace Discard\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

class ProductsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'title' => ['type' => 'string', 'null' => false, 'default' => null],
        'deleted' => ['type' => 'datetime', 'null' => true, 'default' => null],
        'created' => ['type' => 'datetime', 'null' => true, 'default' => null],
        'modified' => ['type' => 'datetime', 'null' => true, 'default' => null],
    ];

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'title' => 'Mug',
            'deleted' => null,
            'created' => '2018-01-01 00:00:00',
            'modified' => '2018-01-02 00:00:00',
        ],
        [
            'id' => 2,
            'title' => 'Tote',
            'deleted' => '2018-01-05 00:00:00',
            'created' => '2018-01-03 00:00:00',
            'modified' => '2018-01-04 00:00:00',
        ],
    ];
}