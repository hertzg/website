<?php

function str_collapse_spaces ($string) {
    return trim(preg_replace('/\s+/', ' ', $string));
}
