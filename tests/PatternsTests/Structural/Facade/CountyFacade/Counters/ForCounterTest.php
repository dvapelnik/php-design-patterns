<?php
namespace PatternsTests\Structural\Facade\CountyFacade\Counters;

use Patterns\Structural\Facade\CountyFacade\Counters\ForCounter;
use PHPUnit_Framework_TestCase;

class ForCounterTest extends PHPUnit_Framework_TestCase
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
        /** @var ForCounter $counter */
        $counter = new ForCounter();

        $this->assertEquals(10, $counter->getSummaryValue(new $className(array(0, 1, 2, 3, 4))));
    }
}