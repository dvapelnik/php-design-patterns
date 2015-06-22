<?php
namespace PatternsTests\Structural\Bridge\ListRenderers\Renderer;

use PHPUnit_Framework_TestCase;
use Patterns\Structural\Bridge\ListRenderer\Renderers\RendererFactory;

class RendererFactoryTest extends PHPUnit_Framework_TestCase
{
    public function argumentProvider()
    {
        return array(
            array(
                'counts'        => range(1, 5),
                'expectedClass' => 'Patterns\Structural\Bridge\ListRenderer\Renderers\FatImplodeRenderer',
            ),
            array(
                'counts'        => range(6, 10),
                'expectedClass' => 'Patterns\Structural\Bridge\ListRenderer\Renderers\SkinnyImplodeRenderer',
            ),
            array(
                'counts'        => range(11, 20, 2),
                'expectedClass' => 'Patterns\Structural\Bridge\ListRenderer\Renderers\ImplodeRenderer',
            ),
        );
    }

    /**
     * @dataProvider argumentProvider
     */
    public function testRendererFactory($counts, $expectedClass)
    {
        foreach ($counts as $count) {
            $this->assertInstanceOf($expectedClass, RendererFactory::getInstance()->getRenderer($count));
        }
    }

    /**
     * @dataProvider argumentProvider
     */
    public function testRendererFactoryIsSingleton($counts, $expectedClass)
    {
        foreach ($counts as $count) {
            $firstFactory = RendererFactory::getInstance()->getRenderer($count);
            $secondFactory = RendererFactory::getInstance()->getRenderer($count);

            $this->assertSame($firstFactory, $secondFactory);
        }
    }
}