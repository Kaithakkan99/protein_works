<?php

class Application_Model_Category
{
    protected $_id;
    protected $_name;
    protected $_url;
    protected $_is_active;
    protected $_created_at;
    protected $_updated_at;
    protected $_deleted_at;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid category property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid category property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    public function getname()
    {
        return $this->_name;
    }

    public function setUrl($url)
    {
        $this->_url = (string) $url;
        return $this;
    }

    public function getUrl()
    {
        return $this->_url;
    }
    public function setIsActive($isActive)
    {
        $this->_is_active = (boolean) $isActive;
        return $this;
    }

    public function getIsActive()
    {
        return $this->_is_active;
    }
    public function setCreatedAt($createdAt)
    {
        $this->_created_at = $createdAt;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->_updated_at = $updatedAt;
        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->_updated_at;
    }
    public function setDeletedAt($deletedAt)
    {
        $this->_deleted_at = $deletedAt;
        return $this;
    }

    public function getDeletedAt()
    {
        return $this->_deleted_at;
    }


}

