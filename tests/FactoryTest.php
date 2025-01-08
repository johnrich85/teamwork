<?php

use Johnrich85\Teamwork\Contracts\RequestableInterface;
use Mockery as m;
use Johnrich85\Teamwork\Factory;

class FactoryTest extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        parent::setUp();
        $this->requestable = m::mock(RequestableInterface::class);
    }

    public function tearDown()
    {
        m::close();
    }

    /**
     * @group factory
     * @expectedException Johnrich85\Teamwork\Exceptions\ClassNotCreatedException
     */
    public function test_that_it_fails_when_object_does_not_exist()
    {
        $factory = new Factory($this->requestable);
        $factory->butts();
    }

    /**
     * @group factory
     */
    public function test_that_it_parses_id_parameter()
    {
        $factory = new Factory($this->requestable);
        $task = $factory->tasks(30);

        $this->assertObjectHasAttribute('id', $task);
        $this->assertEquals(30, $task->getID());
    }

    /**
     * @group factory
     * @expectedException \InvalidArgumentException
     */
    public function test_that_it_only_accepts_integer_as_parameter()
    {
        $factory = new Factory($this->requestable);
        $factory->tasks('butts');
    }
}
