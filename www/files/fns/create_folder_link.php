<?php

function create_folder_link ($id) {
    if ($id) return "index.php?idfolders=$id";
    return 'index.php';
}
