<?php

namespace SendingNotes;

function add ($mysqli, $id_users, $sender_username,
    $receiver_username, $receiver_address, $id_admin_connections,
    $their_exchange_api_key, $text, $tags, $encrypt_in_listings) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $receiver_username = $mysqli->real_escape_string($receiver_username);
    $receiver_address = $mysqli->real_escape_string($receiver_address);
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $encrypt_in_listings = $encrypt_in_listings ? '1' : '0';
    $insert_time = time();

    $sql = 'insert into sending_notes'
        .' (id_users, sender_username, receiver_username,'
        .' receiver_address, id_admin_connections,'
        .' their_exchange_api_key, text, tags,'
        .' encrypt_in_listings, insert_time)'
        ." values ($id_users, '$sender_username', '$receiver_username',"
        ." '$receiver_address', $id_admin_connections,"
        ." '$their_exchange_api_key', '$text', '$tags',"
        ." $encrypt_in_listings, $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
