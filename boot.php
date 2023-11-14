<?php

require "config.php";
require "controller.php";
require "database.php";
require "model.php";

class boot{
    protected $controller = 'Index';
    protected $action = 'index';
    protected $params = [];

    public function __contruct(){
        //echo "booting sukses";

        $url = $_GET['r'];
        $url = $this->parseUrl($url);

        if (file_exists('apps/controllers/'.$url[0].'.php')){
            $this->controller - $url[0];
            unset($url[0]);
        }

        require ('apps/controllers/'.$this->controller.'.php');
        $this->controller = new $this->controller;

        if(isset($url[1])){
            if(method_exists($this->controller,$url[1])){
                $this->action = $url[1];
                unset($url[1]);
            }
        }

        if(!empty($url)){
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->action, $this->params]);
    }
    
    //rooting aplikasi MVC --> dengan memilihkan controller, model, dan view yang dibutuhkan

    public function parseUrl($url){
        if(isset($_GET['r'])){
            $url = rtrim($_GET['r'],'/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/',$url);
        }
        return $url;
    }
}


