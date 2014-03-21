<?php

include_once '../lib/mysqli.php';

function query ($sql) {
    global $mysqli;
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
query('rename table bookmarktags to bookmark_tags');
query('rename table contacttags to contact_tags');
query('rename table notetags to note_tags');
query('rename table tasktags to task_tags');
echo 'Done';
