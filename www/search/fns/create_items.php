<?php

function create_items (array $bookmarks, array $contacts, array $notes,
    array $tasks, array $folders, array $files, $keyword) {

    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
    $encodedKeyword = rawurlencode($keyword);

    $items = [];

    if ($bookmarks) {
        include_once __DIR__.'/render_bookmarks.php';
        render_bookmarks($bookmarks, $items, $regex, $encodedKeyword);
    }

    if ($contacts) {
        include_once __DIR__.'/render_contacts.php';
        render_contacts($contacts, $items, $regex, $encodedKeyword);
    }

    if ($notes) {
        include_once __DIR__.'/render_notes.php';
        render_notes($notes, $items, $regex, $encodedKeyword);
    }

    if ($tasks) {
        include_once __DIR__.'/render_tasks.php';
        render_tasks($tasks, $items, $regex, $encodedKeyword);
    }

    if ($folders) {
        include_once __DIR__.'/render_folders.php';
        render_folders($folders, $items, $regex, $encodedKeyword);
    }

    if ($files) {
        include_once __DIR__.'/render_files.php';
        render_files($files, $items, $regex, $encodedKeyword);
    }

    return $items;

}
