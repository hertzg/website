<?php

function parse_read_write ($access, &$read, &$write) {
    if ($access === 'readonly') {
        $read = true;
        $write = false;
    } elseif ($access === 'readwrite') {
        $read = true;
        $write = true;
    } else {
        $read = false;
        $write = false;
    }
}
