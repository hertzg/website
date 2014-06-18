<?php

function item_type_name ($type) {
    if ($type == 'bookmark' || $type == 'receivedBookmark') return 'Bookmark';
    if ($type == 'contact' || $type == 'receivedContact') return 'Contact';
    if ($type == 'file' || $type == 'receivedFile') return 'File';
    if ($type == 'folder' || $type == 'receivedFolder') return 'Folder';
    if ($type == 'note' || $type == 'receivedNote') return 'Note';
    if ($type == 'task' || $type == 'receivedTask') return 'Task';
}
