<?php

function create_items (array $bookmarks, array $contacts, array $notes,
    array $tasks, array $folders, array $files) {

    $items = [];

    if ($bookmarks) {
        include_once __DIR__.'/render_bookmarks.php';
        render_bookmarks($bookmarks, $items);
    }

    if ($contacts) {
        include_once __DIR__.'/render_contacts.php';
        render_contacts($contacts, $items);
    }

    if ($notes) {
        include_once __DIR__.'/render_notes.php';
        render_notes($notes, $items);
    }

    if ($tasks) {
        include_once __DIR__.'/render_tasks.php';
        render_tasks($tasks, $items);
    }

    if ($folders) {
        include_once __DIR__.'/render_folders.php';
        render_folders($folders, $items);
    }

    if ($files) {
        include_once __DIR__.'/render_files.php';
        render_files($files, $items);
    }

    return $items;

}
