<?php

function str_collapse_lines ($string) {
    return trim(preg_replace('/\n{3,}/', "\n\n", $string));
}
