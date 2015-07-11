<?php
namespace PatternsTests\Structural\Facade\CountyFacade\Counters;

use Patterns\Structural\Bridge\ListRenderer\Lists\AbstractList;
use Patterns\Structural\Bridge\ListRenderer\Lists\ListString;
use Patterns\Structural\Facade\CountyFacade\Counters\ClosureCounter;
use PHPUnit_Framework_TestCase;

class ClosureCounterTest extends PHPUnit_Framework_TestCase
{
    public function abstractListClassesProvider()
    {
        return array(
            array(
                'className' => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListString',
            ),
            array(
                'className' => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListArray',
            ),
        );
    }

    /**
     * @dataProvider abstractListClassesProvider
     */
    public function testGetSummaryValue($className)
    {
        /** @var ClosureCounter $counter */
        $counter = new ClosureCounter();

        $this->assertEquals(10, $counter->getSummaryValue(new $className(array(0, 1, 2, 3, 4))));
    }
}