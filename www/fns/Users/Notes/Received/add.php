<?php

namespace Users\Notes\Received;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $text,
    $tags, $encrypt_in_listings, $sender_address = null) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/Notes/maxLengths.php";
    include_once "$fnsDir/text_title.php";
    $title = text_title($text, \Notes\maxLengths()['title']);

    include_once "$fnsDir/ReceivedNotes/add.php";
    \ReceivedNotes\add($mysqli, $sender_address,
        $sender_id_users, $sender_username, $receiver_id_users,
        $text, $title, $tags, $encrypt_in_listings);

    $sql = 'update users set num_received_notes = num_received_notes + 1,'
        .' home_num_new_received_notes = home_num_new_received_notes + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
