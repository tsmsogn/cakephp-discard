<?php
namespace Discard\Test\TestCase\Model\Behavior;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Discard\Model\Behavior\DiscardableBehavior;

/**
 * Discard\Model\Behavior\DiscardableBehavior Test Case
 */
class DiscardableBehaviorTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.discard.products',
    ];


    /**
     * @var \Discard\Test\TestApp\Model\Table\ProductsTable
     */
    public $Products;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        TableRegistry::clear();
        $this->Products = TableRegistry::get('Products', [
            'className' => 'Discard\Test\TestApp\Model\Table\ProductsTable'
        ]);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Products);

        parent::tearDown();
    }

    public function testFindDiscarded()
    {
        $discarded = $this->Products
            ->find('discarded')
            ->toArray();

        $this->assertCount(1, $discarded);
        $this->assertEquals(2, $discarded[0]->id);
    }

    public function testFindKept()
    {
        $kept = $this->Products
            ->find('kept')
            ->toArray();

        $this->assertCount(1, $kept);
        $this->assertEquals(1, $kept[0]->id);
    }

    public function testDiscard()
    {
        $mug = $this->Products->get(1);
        $this->Products->discard($mug);

        $this->assertTrue($this->Products->isDiscarded(['id' => 1]));
    }

    public function testUndiscard()
    {
        $tote = $this->Products->get(2);
        $this->Products->undiscard($tote);

        $this->assertTrue($this->Products->isUndiscarded(['id' => 2]));
    }

    public function testIsDiscarded()
    {
        $this->assertTrue($this->Products->isDiscarded(['id' => 2]));
    }

    public function testIsUndiscarded()
    {
        $this->assertTrue($this->Products->isUndiscarded(['id' => 1]));
    }

}
