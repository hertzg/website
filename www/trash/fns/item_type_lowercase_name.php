<?php

function item_type_lowercase_name ($type) {
    if ($type == 'barChart') return 'Bar chart';
    if ($type == 'bookmark' || $type == 'receivedBookmark') return 'Bookmark';
    if ($type == 'contact' || $type == 'receivedContact') return 'Contact';
    if ($type == 'event') return 'Event';
    if ($type == 'file' || $type == 'receivedFile') return 'File';
    if ($type == 'folder' || $type == 'receivedFolder') return 'Folder';
    if ($type == 'note' || $type == 'receivedNote') return 'Note';
    if ($type == 'place' || $type == 'receivedPlace') return 'Place';
    if ($type == 'schedule' || $type == 'receivedSchedule') return 'Schedule';
    if ($type == 'task' || $type == 'receivedTask') return 'Task';
    if ($type == 'wallet') return 'Wallet';
}
