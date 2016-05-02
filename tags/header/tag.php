<?php
    include Hiss::$dir.'lib/Hiss/elements/header/Header.php';
    function hiss_header($tag){
        return PlaceholderParser::parse(Header::getHTML());
    }

