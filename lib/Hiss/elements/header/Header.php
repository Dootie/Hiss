<?php

class Header {
    public static $title = "Hiss";
    public static $description = "The framework for create websites.";
    public static $active = true;
    
    public static function getHTML() {
        if(!Header::$active){ return ''; }
        $template = file_get_contents(Hiss::$dir.'templates/header.html');
        
        $template = str_replace('$_HEADER{name}', Header::$title, $template);
        $template = str_replace('$_HEADER{description}', Header::$description, $template);
        return $template;
    }
}