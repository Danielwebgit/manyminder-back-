<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Middleware
{
    protected $ci;
    protected $middlewares = array();

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function load($middleware, $params = array())
    {
        $this->middlewares[] = array(
            'middleware' => $middleware,
            'params' => $params
        );
    }

    public function run()
    {
        foreach ($this->middlewares as $middleware)
        {
            $this->ci->load->library($middleware['middleware'], $middleware['params']);
            $this->ci->$middleware['middleware']->run();
        }
    }
}