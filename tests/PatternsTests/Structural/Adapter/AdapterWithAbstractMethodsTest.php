<?php
namespace PatternsTests\Structural\Adapter;

use Patterns\Structural\Adapter\AdapterWithAbstractMethods\StructurePrinterInterface;
use PHPUnit_Framework_TestCase;

class AdapterWithAbstractMethodsTest extends PHPUnit_Framework_TestCase
{
    public function argumentsProvider()
    {
        return array(
            array(
                'classes'        => array(
                    'structure' => 'Patterns\Structural\Adapter\Structures\EmployeeStructure',
                    'adapter'   => 'Patterns\Structural\Adapter\AdapterWithAbstractMethods\EmployeePrinter',
                ),
                'head'           => 'Head employee',
                'slaves'         => array('Foo employee', 'Bar employee', 'Baz employee', 'Beez employee'),
                'expectedResult' => 'Head employee (Foo employee, Bar employee, Baz employee, Beez employee)'
            ),
            array(
                'classes'        => array(
                    'structure' => 'Patterns\Structural\Adapter\Structures\CountryStructure',
                    'adapter'   => 'Patterns\Structural\Adapter\AdapterWithAbstractMethods\CountryPrinter',
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

        /** @var StructurePrinterInterface $printer */
        $printer = new $classes['adapter']($structure);

        $this->assertEquals($expectedResult, $printer->getString());
    }
}