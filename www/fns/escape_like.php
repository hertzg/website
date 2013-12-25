<?php

function escape_like ($str) {
    return str_replace(
        array('\\', '%', '_'),
        array('\\\\', '\\%', '\\_'),
        $str
    );
}
