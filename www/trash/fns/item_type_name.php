<?php

function item_type_name ($data_type) {
    if ($data_type == 'bookmark') return 'Bookmark';
    if ($data_type == 'contact') return 'Contact';
    if ($data_type == 'note') return 'Note';
    if ($data_type == 'task') return 'Task';
}
