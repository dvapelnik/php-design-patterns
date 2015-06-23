<?php
namespace PatternsTests\Structural\Bridge\Views\View;

use Patterns\Structural\Bridge\Views\View\ViewContent;
use Patterns\Structural\Bridge\Views\View\ViewTable;
use PHPUnit_Framework_TestCase;

class ViewTest extends PHPUnit_Framework_TestCase
{
    private $_text = 'some text';

    public function argumentContentProvider()
    {
        return array(
            array(
                'environment'    => 'CLI',
                'expectedResult' => $this->_text . PHP_EOL,
            ),
            array(
                'environment'    => 'JSON',
                'expectedResult' => json_encode(array(array('type' => 'text', 'text' => $this->_text))),
            ),
        );
    }

    public function argumentTableProvider()
    {
        return array(
            array(
                'environment'    => 'CLI',
                'expectedResult' => implode(PHP_EOL, array(
                        str_repeat('-', 80),
                        $this->_text,
                        str_repeat('-', 80),
                    )) . PHP_EOL,
            ),
            array(
                'environment'    => 'JSON',
                'expectedResult' => json_encode(array(
                    array('type' => 'line'),
                    array('type' => 'text', 'text' => $this->_text),
                    array('type' => 'line'),
                )),
            ),
        );
    }

    /**
     * @dataProvider argumentContentProvider
     */
    public function testViewContent($environment, $expectedResult)
    {
        /** @var ViewContent $view */
        $view = new ViewContent($environment);

        $view->printParagraph($this->_text);

        $this->assertEquals($expectedResult, $view->getResult());
    }

    /**
     * @dataProvider argumentTableProvider
     */
    public function testViewJSON($environment, $expectedResult)
    {
        $view = new ViewTable($environment);

        $view->drawCell($this->_text);

        $this->assertEquals($expectedResult, $view->getResult());
    }
}