<?php

class Application_Model_CategoryMapper
{
    protected $_table;

    public function setDbTable($table)
    {
        if (is_string($table)) {
            $table = new $table();
        }
        if (!$table instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_table = $table;
        return $this;
    }

    public function getTable()
    {
        if (null === $this->_table) {
            $this->setDbTable('Application_Model_DbTable_Category');
        }
        return $this->_table;
    }

    public function save(Application_Model_Category $category)
    {
        // hardcoding url for now . Move to the form
        $data = array(
            'name'   => $category->getName(),
            'url' => 'category/view/' . $category->getUrl(),
        );
        try {
            if (null === ($id = $category->getId())) {
                unset($data['id']);
                $this->getTable()->insert($data);
            } else {
                $this->getTable()->update($data, array('id = ?' => $id));
            }
        }catch (Zend_Db_Exception $e) {
            // error thrown by dbtable class
            return $e->getMessage();
        }
        return true;
    }

    public function find($id, Application_Model_Category $category)
    {
        $result = $this->getTable()->find($id);
        if (count($result) == 0) {
            return false;
        }

        return  $this->mapping($result->current());

    }

    public function fetchAll()
    {
        $resultSet = $this->getTable()->fetchAll();
        if (count($resultSet) == 0) {
            return false;
        }

        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Category();
            $entries[] = $this->mapping($row);
        }
        return $entries;
    }

    public function fetchByUrl($url = NULL)
    {
        if (empty($url)) {
            return false;
        }
        $result = $this->getTable()->fetchAll("url = '$url'");
        if (count($result) == 0) {
            return false;
        }

        return  $this->mapping($result->current());

    }

    private function mapping ( $category) {

        $categoryObj = new Application_Model_Category();
        return $categoryObj->setId($category->id)
                    ->setName($category->name)
                    ->setUrl($category->url)
                    ->setIsActive($category->is_active)
                    ->setCreatedAt($category->created_at)
                    ->setUpdatedAt($category->updated_at)
                    ->setDeletedAt($category->deleted_at);

    }

}

