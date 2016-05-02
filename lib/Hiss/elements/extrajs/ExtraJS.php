<?php

class ExtraJS {
    public static $extraJS = array();
    
    public static function getAllJSString(){
        $extra = '';
        foreach (ExtraJS::$extraJS as $script) {
            $extra = $extra.$script;
        }
        return $extra;
    }
}
