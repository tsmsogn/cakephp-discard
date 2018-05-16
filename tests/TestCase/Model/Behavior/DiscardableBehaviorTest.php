<?php
namespace Discard\Test\TestCase\Model\Behavior;

use Cake\TestSuite\TestCase;
use Discard\Model\Behavior\DiscardableBehavior;

/**
 * Discard\Model\Behavior\DiscardableBehavior Test Case
 */
class DiscardableBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Discard\Model\Behavior\DiscardableBehavior
     */
    public $Discardable;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Discardable = new DiscardableBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Discardable);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
