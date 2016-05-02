<?php

class DirectoryParser {
    public static $dir = array();
    public static $error = 0;
    
    public static function getCurrentPage(){
        return
            (DirectoryParser::$error == 0 ?
                (isset($_GET['p'])?
                    filter_input(INPUT_GET, 'p'):
                    "index"
                ):
                strval(DirectoryParser::$error)
            );
    }
    
    public static function getRelativeDots(){
        $back = 0;
        if(isset($_GET['p'])){
            $back = substr_count($_GET['p'], '/');
        }
        return str_repeat('../', $back);
    }
}
