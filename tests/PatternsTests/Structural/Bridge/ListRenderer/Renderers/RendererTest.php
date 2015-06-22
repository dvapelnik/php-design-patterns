<?php
namespace PatternsTests\Structural\Bridge\ListRenderers\Renderer;

use PHPUnit_Framework_TestCase;

class RendererTest extends PHPUnit_Framework_TestCase
{
    public function argumentProvider()
    {
        return array(
            array(
                'itemsInput'    => range(0, 2),
                'itemsOutput'   => '0, 1, 2',
                'rendererClass' => 'Patterns\Structural\Bridge\ListRenderer\Renderers\FatImplodeRenderer',
            ),
            array(
                'itemsInput'    => range(0, 5),
                'itemsOutput'   => '0|1|2|3|4|5',
                'rendererClass' => 'Patterns\Structural\Bridge\ListRenderer\Renderers\SkinnyImplodeRenderer',
            ),
            array(
                'itemsInput'    => range(0, 10),
                'itemsOutput'   => '012345678910',
                'rendererClass' => 'Patterns\Structural\Bridge\ListRenderer\Renderers\ImplodeRenderer',
            ),
        );
    }

    /**
     * @dataProvider argumentProvider
     */
    public function testRenderer($itemsInput, $itemsOutput, $rendererClass)
    {
        $this->assertEquals($itemsOutput, $rendererClass::getInstance()->render($itemsInput));
    }

    /**
     * @dataProvider argumentProvider
     */
    public function testRenderersIsSingleton($itemsInput, $itemsOutput, $rendererClass)
    {
        $firstRenderer = $rendererClass::getInstance();
        $secondRenderer = $rendererClass::getInstance();

        $this->assertSame($firstRenderer, $secondRenderer);
    }
}