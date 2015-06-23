<?php
namespace PatternsTests\Structural\Bridge\Views\View;

use Patterns\Structural\Bridge\Views\View\ViewContent;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class AbstractViewTest extends PHPUnit_Framework_TestCase
{
    public function constructorProvider()
    {
        return array(
            array(
                'environment'      => 'CLI',
                'expectedImlClass' => 'Patterns\Structural\Bridge\Views\ViewImpl\ViewImplCLI',
            ),
            array(
                'environment'      => 'JSON',
                'expectedImlClass' => 'Patterns\Structural\Bridge\Views\ViewImpl\ViewImplJSON',
            ),
        );
    }

    /**
     * @dataProvider constructorProvider
     */
    public function testConstructor($environment, $expectedImlClass)
    {
        $view = new ViewContent($environment);

        $viewReflected = new ReflectionClass('Patterns\Structural\Bridge\Views\View\ViewContent');
        $viewReflectedImplProperty = $viewReflected->getProperty('_impl');
        $viewReflectedImplProperty->setAccessible(true);

        $this->assertInstanceOf($expectedImlClass, $viewReflectedImplProperty->getValue($view));
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Unknown environment
     */
    public function testExceptionInConstructor()
    {
        $view = new ViewContent('WRONG_ENVIRONMENT');
    }

    /**
     * @dataProvider constructorProvider
     */
    public function testGetImplementation($environment, $expectedImplClass)
    {
        $view = new ViewContent($environment);

        $viewReflected = new ReflectionClass('Patterns\Structural\Bridge\Views\View\ViewContent');

        $viewReflectedImplProperty = $viewReflected->getProperty('_impl');
        $viewReflectedImplProperty->setAccessible(true);

        $viewReflectedGetImplementationMethod = $viewReflected->getMethod('_getImplementation');
        $viewReflectedGetImplementationMethod->setAccessible(true);

        $this->assertSame(
            $viewReflectedImplProperty->getValue($view),
            $viewReflectedGetImplementationMethod->invoke($view));
    }
}