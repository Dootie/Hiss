<?php
    function hiss_navbar($tag){
        return PlaceholderParser::parse(Navbar::getHTML());
    }

