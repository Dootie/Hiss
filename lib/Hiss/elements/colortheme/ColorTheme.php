<?php

class ColorTheme {
    
    public static function setColorMeta($color, $mode = 0){
        include_once Hiss::$dir.'lib/hiss/elements/extrajs/ExtraJS.php';
        ColorTheme::pushJS("<script>setColorThemeMeta('$color');</script>", $mode);
    }
    
    private static function pushJS($string, $mode){
        if($mode == 0){
            array_push(ExtraJS::$extraJS, $string);
        }else{
            /* TODO */
        }
    }
}
