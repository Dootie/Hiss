<?php
    function hiss_include($tag){
        include_once Hiss::$dir.'lib/Hiss/DirectoryParser.php';
        include_once Hiss::$dir.'lib/Hiss/PlaceholderParser.php';
        if(isset($tag['attributes']->template)){
            $filename = Hiss::$dir.'templates/'.str_replace('{p}', DirectoryParser::getCurrentPage(), $tag['attributes']->template).'.html';
            if(file_exists($filename)){
                return PlaceholderParser::parse(file_get_contents($filename));
            }else{
                header("Location: ?error=404");
                exit();
            }
        }
        
        $back = 0;
        if(isset($_GET['p'])){
            $back = substr_count($_GET['p'], '/');
        }
        if(isset($tag['attributes']->javascript)){
            return '<script src="'.str_repeat('../', $back).'js/'.$tag['attributes']->javascript.'.js"></script>';
        }
        if(isset($tag['attributes']->css)){
            return '<link rel="stylesheet" type="text/css" href="'.str_repeat('../', $back).'css/'.$tag['attributes']->css.'.css">';
        }
    }