<?php

class ConfigFile {
    
    private $file;
    private $config;
    
    function __construct($file){
        $config = array();
        include Hiss::$dir.'data/'.$file;
        $this->file = $file;
        $this->config = $config;
    }
    
    function get(){ return $this->config; }
}