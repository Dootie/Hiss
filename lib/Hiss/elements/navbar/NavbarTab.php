<?php

class NavbarTab {
    public $name = "Tab";
    public $url = "#";
    public $active = false;
    
    public static function create($name, $url, $active){
        return new NavbarTab($name, $url, $active);
    }
}
