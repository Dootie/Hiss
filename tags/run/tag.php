<?php
    function hiss_run($tag){
        if(isset($tag['attributes']->file) && isset($tag['attributes']->method)){
            include Hiss::$dir.$tag['attributes']->file.'.php';
            return call_user_func($tag['attributes']->method);
        }else{
            return eval($tag['content']);
        }
    }