<?php

include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$ids = mysqli_query_object(
    $mysqli,
    'select distinct idbookmarks value from bookmarktags'
);
foreach ($ids as $id) {
    $bookmark = mysqli_single_object(
        $mysqli,
        "select * from bookmarks where idbookmarks = $id->value"
    );
    if ($bookmark) {
        $title = mysqli_real_escape_string($mysqli, $bookmark->title);
        $url = mysqli_real_escape_string($mysqli, $bookmark->url);
        mysqli_query(
            $mysqli,
            'update bookmarktags set'
            ." title = '$title',"
            ." url = '$url',"
            ." inserttime = $bookmark->inserttime,"
            ." updatetime = $bookmark->updatetime"
            ." where idbookmarks = $bookmark->idbookmarks"
        );
    }
}

$ids = mysqli_query_object(
    $mysqli,
    'select distinct idnotes value from notetags'
);
foreach ($ids as $id) {
    $note = mysqli_single_object(
        $mysqli,
        "select * from notes where idnotes = $id->value"
    );
    if ($note) {
        $notetext = mysqli_real_escape_string($mysqli, $note->notetext);
        mysqli_query(
            $mysqli,
            'update notetags set'
            ." notetext = '$notetext',"
            ." inserttime = $note->inserttime,"
            ." updatetime = $note->updatetime"
            ." where idnotes = $note->idnotes"
        );
    }
}

$ids = mysqli_query_object(
    $mysqli,
    'select distinct idtasks value from tasktags'
);
foreach ($ids as $id) {
    $task = mysqli_single_object(
        $mysqli,
        "select * from tasks where idtasks = $id->value"
    );
    if ($task) {
        $tasktext = mysqli_real_escape_string($mysqli, $task->tasktext);
        mysqli_query(
            $mysqli,
            'update tasktags set'
            ." tasktext = '$tasktext',"
            ." top_priority = $task->top_priority,"
            ." inserttime = $task->inserttime,"
            ." updatetime = $task->updatetime"
            ." where idtasks = $task->idtasks"
        );
    }
}

echo 'Done';
