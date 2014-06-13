<?php

function item_type_name ($type) {
    if ($type == 'bookmark') return 'Bookmark';
    if ($type == 'contact') return 'Contact';
    if ($type == 'file') return 'File';
    if ($type == 'note') return 'Note';
    if ($type == 'receivedBookmark') return 'Received Bookmark';
    if ($type == 'receivedContact') return 'Received Contact';
    if ($type == 'receivedFile') return 'Received File';
    if ($type == 'receivedNote') return 'Received Note';
    if ($type == 'receivedTask') return 'Received Task';
    if ($type == 'task') return 'Task';
}
