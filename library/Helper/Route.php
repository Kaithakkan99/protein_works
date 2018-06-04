<?php
/*
 * For validate dynamic url and redirect to the requested controller
 */

class Helper_Route {

    public function validateURL($bootstrap, $url = NULL) {
        if (empty($url)) {
            return false;
        }
        $url = trim($url, '/');
        $urlArray = explode('/', $url);
        if (count($urlArray) > 1) {
            $requestType = $urlArray[0] . '/' . $urlArray[1];
        } else {
            $requestType = $urlArray[0];
        }

        switch ($requestType) {
            case "product/view":
                $model      = 'Application_Model_ProductMapper';
                $controller = 'product';
                break;
            case "category/view":
                $model      = 'Application_Model_CategoryMapper';
                $controller = 'category';
                break;
            default:
                return false;
        }

        $resource = $bootstrap->getPluginResource('db');
        $db       = $resource->getDbAdapter();

        $modelObjectMapper = new $model();

        $result = $modelObjectMapper->fetchByUrl($url);

        if ($result !== false && count($result) > 0) {

            $router = Zend_Controller_Front::getInstance()->getRouter();

            $router->addRoute($controller, new Zend_Controller_Router_Route($url, array(
                'module' => 'default',
                'controller' => $controller,
                'action' => 'edit'
            )));
        }
    }
}

