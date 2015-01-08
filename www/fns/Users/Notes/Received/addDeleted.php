<?php

namespace Users\Notes\Received;

function addDeleted ($mysqli, $receiver_id_users, $data) {

    $text = $data->text;
    $archived = $data->archived;

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Notes/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Notes\maxLengths()['title']);

    include_once "$fnsDir/ReceivedNotes/addDeleted.php";
    \ReceivedNotes\addDeleted($mysqli, $data->id, $data->sender_id_users,
        $data->sender_username, $receiver_id_users, $text, $title,
        $data->tags, $data->encrypt, $archived, $data->insert_time);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receiver_id_users, 1);

    if ($archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $receiver_id_users, 1);
    }

}
