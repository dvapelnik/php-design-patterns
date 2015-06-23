<?php
namespace Patterns\Structural\Bridge\Views\View;

use Exception;
use Patterns\Structural\Bridge\Views\ViewImpl\AbstractViewImpl;
use Patterns\Structural\Bridge\Views\ViewImpl\ViewImplCLI;
use Patterns\Structural\Bridge\Views\ViewImpl\ViewImplJSON;

abstract class AbstractView
{
    /** @var AbstractViewImpl */
    protected $_impl = null;

    public function __construct($environment)
    {
        // Здесь это сделано для упращения примера, в реальной же ситуации следует
        // использовать абстракную фабрику

        if ($environment == 'CLI') {
            $this->_impl = new ViewImplCLI();
        } else {
            if ($environment == 'JSON') {
                $this->_impl = new ViewImplJSON();
            } else {
                throw new Exception('Unknown environment');
            }
        }
    }

    /**
     * @return AbstractViewImpl
     */
    protected function _getImplementation()
    {
        return $this->_impl;
    }

    public function drawText($text)
    {
        return $this->_getImplementation()->drawText($text);
    }

    public function drawLine()
    {
        return $this->_getImplementation()->drawLine();
    }

    public function getResult()
    {
        return $this->_getImplementation()->getResult();
    }
}