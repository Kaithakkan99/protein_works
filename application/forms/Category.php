<?php

class Application_Form_Category extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */

        $this->setName("category");
        $this->setMethod('post');

        $this->addElement('text', 'name', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(0, 50)),
            ),
            'required' => true,
            'label' => 'Name',
            'class' =>'form-control',
        ));

        /*
         *@TODO:findout for the url validator and replace with that
         */
        $this->addElement('text', 'url', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', false, array(0, 50)),
            ),
            'required' => true,
            'label' => 'Url : /category/view/',
            'class' =>'form-control',
        ));

        $this->addElement('submit', 'create', array(
            'required' => false,
            'ignore' => true,
            'label' => 'Create',
            'class' => 'btn btn-primary'
        ));

    }


}

