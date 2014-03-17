<?php

include_once '../lib/mysqli.php';

$mysqli->query('alter table users add order_home_items text character set ascii');

$order_home_items = $mysqli->real_escape_string(
    json_encode(array(
        'bookmarks', 'new-bookmark', 'calendar', 'contacts', 'new-contact',
        'files', 'notes', 'new-note', 'notifications', 'tasks', 'new-task',
    ))
);

$mysqli->query("update users set order_home_items = '$order_home_items'");

echo 'Done.';
