<?php

namespace ReceivedFiles;

function addDeleted ($mysqli, $id, $sender_address,
    $sender_id_users, $sender_username, $receiver_id_users,
    $content_type, $media_type, $name, $size, $hashes_computed,
    $md5_sum, $sha256_sum, $archived, $insert_time) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);
    $hashes_computed = $hashes_computed ? '1' : '0';
    $archived = $archived ? '1' : '0';

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = 'insert into received_files'
        .' (id, sender_address, sender_id_users, sender_username,'
        .' receiver_id_users, content_type, media_type, name,'
        .' size, readable_size, hashes_computed, md5_sum, sha256_sum,'
        .' archived, insert_time, committed)'
        ." values ($id, $sender_address, $sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$content_type', '$media_type', '$name',"
        ." $size, '$readable_size', 1, '$md5_sum', '$sha256_sum',"
        ." $archived, $insert_time, 1)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
