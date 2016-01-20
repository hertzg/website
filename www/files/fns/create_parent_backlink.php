<?php

function create_parent_backlink ($id, $base, $hash) {

    if ($id) {
        $title = "Folder #$id";
        $query = "?id_folders=$id";
    } else {
        $title = 'Files';
        $query = '';
    }

    return [
        'title' => $title,
        'href' => "$base$query#$hash",
    ];

}
