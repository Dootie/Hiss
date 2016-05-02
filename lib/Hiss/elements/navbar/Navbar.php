<?php

class Navbar {
    public static $name = "Hiss";
    public static $url = "index";
    public static $righttabs = array();
    public static $lefttabs = array();
    public static $active = true;
    
    public static function getHTML() {
        if(!Navbar::$active){ return ''; }
        include_once 'NavbarTab.php';
        $template = file_get_contents(Hiss::$dir.'templates/navbar.html');
        $parts = explode('<!-- explode -->', $template);
        
        $html = $parts[0];
        
        $htmlrighttab = '';
        foreach(Navbar::$righttabs as $rt){
            $htmltab = $parts[2];
            $htmltab = str_replace("{name}", $rt->name, $htmltab);
            $htmltab = str_replace("{url}", $rt->url, $htmltab);
            if(!$rt->active){
                $htmltab = str_replace(' hiss-theme-primary-background-light', '', $htmltab);
            }
            $htmlrighttab = $htmlrighttab.$htmltab;
        }
        $htmllefttab = '';
        foreach(Navbar::$lefttabs as $lt){
            $htmltab = $parts[1];
            $htmltab = str_replace("{name}", $lt->name, $htmltab);
            $htmltab = str_replace("{url}", $lt->url, $htmltab);
            if(!$lt->active){
                $htmltab = str_replace('hiss-theme-primary-background-light', '', $htmltab);
            }
            $htmllefttab = $htmllefttab.$htmltab;
        }
        $htmlhidetab = '';
        foreach(Navbar::$lefttabs as $lt){
            $htmltab = $parts[3];
            $htmltab = str_replace("{name}", $lt->name, $htmltab);
            $htmltab = str_replace("{url}", $lt->url, $htmltab);
            if(!$lt->active){
                $htmltab = str_replace('hiss-theme-primary-background-light', '', $htmltab);
            }
            $htmlhidetab = $htmlhidetab.$htmltab;
        }
        foreach(Navbar::$righttabs as $rt){
            $htmltab = $parts[3];
            $htmltab = str_replace("{name}", $rt->name, $htmltab);
            $htmltab = str_replace("{url}", $rt->url, $htmltab);
            if(!$rt->active){
                $htmltab = str_replace(' hiss-theme-primary-background-light', '', $htmltab);
            }
            $htmlhidetab = $htmlhidetab.$htmltab;
        }
        $html = str_replace("{website-name}", Navbar::$name, $html);
        $html = str_replace("{website-url}", Navbar::$url, $html);
        $html = str_replace("{right-tabs}", $htmlrighttab, $html);
        $html = str_replace("{left-tabs}", $htmllefttab, $html);
        $html = str_replace("{hide-tabs}", $htmlhidetab, $html);
        return $html;
    }
}