<?php
namespace PatternsTests\Structural\Adapter;

use Patterns\Structural\Adapter\AdapterWithDelegate\StructurePrinter;
use PHPUnit_Framework_TestCase;

class AdapterWithDelegateTest extends PHPUnit_Framework_TestCase
{
    public function argumentsProvider()
    {
        return array(
            array(
                'classes'        => array(
                    'structure' => 'Patterns\Structural\Adapter\Structures\EmployeeStructure',
                    'adapter'   => 'Patterns\Structural\Adapter\AdapterWithDelegate\EmployeeAdapter',
                    'printer'   => 'Patterns\Structural\Adapter\AdapterWithDelegate\StructurePrinter',
                ),
                'head'           => 'Head employee',
                'slaves'         => array('Foo employee', 'Bar employee', 'Baz employee', 'Beez employee'),
                'expectedResult' => 'Head employee (Foo employee, Bar employee, Baz employee, Beez employee)'
            ),
            array(
                'classes'        => array(
                    'structure' => 'Patterns\Structural\Adapter\Structures\CountryStructure',
                    'adapter'   => 'Patterns\Structural\Adapter\AdapterWithDelegate\CountryAdapter',
                    'printer'   => 'Patterns\Structural\Adapter\AdapterWithDelegate\StructurePrinter',
                ),
                'head'           => 'Head country',
                'slaves'         => array('Foo country', 'Bar country', 'Baz country', 'Beez country'),
                'expectedResult' => 'Head country (Foo country, Bar country, Baz country, Beez country)'
            ),
        );
    }

    /**
     * @dataProvider argumentsProvider
     */
    public function testAdapter($classes, $head, $slaves, $expectedResult)
    {
        $structure = new $classes['structure']($head, $slaves);

        /** @var StructurePrinter $printer */
        $printer = new $classes['printer']($structure);

        $printer->setAdapter(new $classes['adapter']);

        $this->assertEquals($expectedResult, $printer->getString());
    }

    /**
     * @dataProvider argumentsProvider
     * @expectedException \Patterns\Structural\Adapter\AdapterWithDelegate\StructurePrinterException
     * @expectedExceptionMessage Delegate adapter not specified
     */
    public function testAdapterWithDelegateNotSpecifiedException($classes, $head, $slaves, $expectedResult)
    {
        $structure = new $classes['structure']($head, $slaves);

        /** @var StructurePrinter $printer */
        $printer = new $classes['printer']($structure);

        $string = $printer->getString();
    }
}