<?php

function create_folder_link ($id, $base = './') {
    if ($id) return "$base?id_folders=$id";
    return $base;
}
