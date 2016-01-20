<?php

function create_parent_url ($id, $base = './') {
    if ($id) return "$base?id_folders=$id";
    return $base;
}
