<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $categories = new Application_Model_CategoryMapper();
        $this->view->categories = $categories->fetchAll();
    }

    public function createAction()
    {
        // action body
        $form = new Application_Form_Category();
        $request = $this->getRequest();
        $errorMessage = NULL;
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {

                $category = new Application_Model_Category($form->getValues());
                $categories = new Application_Model_CategoryMapper();
                $result = $categories->save($category);

                if ($result === true) {
                    $this->_helper->redirector('index', 'category');
                } else {
                    $errorMessage = "Error When creating category ! please try again later";
                }


            }
        }
        /*
         * @TODO:Need to use FlashMessage for all errors
         */
        $this->view->errorMessage = $errorMessage;
        $this->view->form = $form;
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }

    public function viewAction()
    {
        // action body
    }


}









