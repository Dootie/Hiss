<?php

class PlaceholderParser {
    public static function parse($string){
        $lang = new ConfigFile('lang.php');
        $string = PlaceholderParser::advancedParser($lang->get(), $string, 'LANG');
        $config = new ConfigFile('config.php');
        $string = PlaceholderParser::advancedParser($config->get(), $string, 'CONFIG');
        $string = PlaceholderParser::advancedParser(DirectoryParser::getRelativeDots(), $string, 'RELATIVEDOTS');
        return $string;
    }
    
    private static function advancedParser($array, $string, $placeholder, $map = '', $level = 0){
        if(is_array($array)){
            foreach ($array as $k => $v) {
                if(is_array($v)){
                    $string = PlaceholderParser::advancedParser($v, $string, $placeholder, (($level==0)?$k:$map.'.'.$k), $level+1);
                }else{
                    $string = str_replace('$_'.$placeholder.'{'.(($level==0)?$k:$map.'.'.$k).'}', $v, $string);
                }
            }
        }else{
            $string = str_replace('$_'.$placeholder.'{}', $array, $string);
        }
        return $string;
    }
}