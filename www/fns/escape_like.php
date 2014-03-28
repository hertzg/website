<?php

function escape_like ($str) {
    return str_replace(
        ['\\', '%', '_'],
        ['\\\\', '\\%', '\\_'],
        $str
    );
}
