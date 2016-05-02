<?php

function hiss_extrajs($tag){
    include_once Hiss::$dir.'lib/Hiss/elements/extrajs/ExtraJS.php';
    return ExtraJS::getAllJSString();
}