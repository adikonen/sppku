<?php

class Request
{
    /**
     * @var array $data
     */
    protected $data = [];

    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    /**
     * select the request by its key
     * @return array
     */
    public function only(...$fields)
    {
        $result = [];
        foreach($fields as $field) {
            $result[$field] = $this->data[$field];  
        }
        return $result;
    }

    /**
     * get all request
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * get the request by its key
     * @return string|mixed
     */
    public function input($input)
    {
        if (! array_key_exists($input, $this->data)) {
            return null;
        }
        return $this->data[$input];
    }
}