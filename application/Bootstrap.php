<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initRoutes()
    {
        $routeHelper = new Helper_Route();

        $routeHelper->validateURL($this , $_SERVER['REQUEST_URI']);
    }

    protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

}

