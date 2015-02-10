<?php

function item_type_title ($type) {
    if ($type == 'bookmark') return 'Bookmark';
    if ($type == 'contact') return 'Contact';
    if ($type == 'file') return 'File';
    if ($type == 'folder') return 'Folder';
    if ($type == 'note') return 'Note';
    if ($type == 'place') return 'Place';
    if ($type == 'receivedBookmark') return 'Received Bookmark';
    if ($type == 'receivedContact') return 'Received Contact';
    if ($type == 'receivedFile') return 'Received File';
    if ($type == 'receivedFolder') return 'Received Folder';
    if ($type == 'receivedNote') return 'Received Note';
    if ($type == 'receivedPlace') return 'Received Place';
    if ($type == 'receivedTask') return 'Received Task';
    if ($type == 'task') return 'Task';
}
