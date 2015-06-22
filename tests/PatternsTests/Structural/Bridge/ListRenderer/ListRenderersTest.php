<?php
namespace PatternsTests\Structural\Bridge\ListRenderer;

use Patterns\Structural\Bridge\ListRenderer\Lists\ListInterface;

class ListRenderersTest extends \PHPUnit_Framework_TestCase
{
    public function argumentsProvider()
    {
        return array(
            array(
                'itemsInput'  => range(0, 2),
                'itemsOutput' => '0, 1, 2',
                'listClass'   => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListArray',
            ),
            array(
                'itemsInput'  => range(0, 5),
                'itemsOutput' => '0|1|2|3|4|5',
                'listClass'   => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListArray',
            ),
            array(
                'itemsInput'  => range(0, 10),
                'itemsOutput' => '012345678910',
                'listClass'   => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListArray',
            ),
            array(
                'itemsInput'  => range(0, 2),
                'itemsOutput' => '0, 1, 2',
                'listClass'   => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListString',
            ),
            array(
                'itemsInput'  => range(0, 5),
                'itemsOutput' => '0|1|2|3|4|5',
                'listClass'   => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListString',
            ),
            array(
                'itemsInput'  => range(0, 10),
                'itemsOutput' => '012345678910',
                'listClass'   => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListString',
            ),
        );
    }

    /**
     * @dataProvider argumentsProvider
     */
    public function testListsAndRenderers($itemsInput, $itemsOutput, $listClass)
    {
        /** @var ListInterface $list */
        $list = new $listClass($itemsInput);

        $this->assertEquals($itemsOutput, $list->getRenderedItems());
    }
}