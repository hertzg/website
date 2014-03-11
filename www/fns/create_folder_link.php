<?php

function create_folder_link ($id, $base = './') {
    if ($id) return "$base?idfolders=$id";
    return $base;
}
