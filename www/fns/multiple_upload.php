<?php

function multiple_upload (array $file) {
    if (!is_array($file['error'])) {
        foreach ($file as $key => &$value) {
            $value = array($value);
        }
    }
    return $file;
}
