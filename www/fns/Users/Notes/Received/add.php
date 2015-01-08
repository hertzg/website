<?php

namespace Users\Notes\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $text, $tags, $encrypt) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Notes/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Notes\maxLengths()['title']);

    include_once "$fnsDir/ReceivedNotes/add.php";
    \ReceivedNotes\add($mysqli, $sender_id_users, $sender_username,
        $receiver_id_users, $text, $title, $tags, $encrypt);

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
