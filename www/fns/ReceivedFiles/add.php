<?php

namespace ReceivedFiles;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $name, $size) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ContentType/detect.php";
    $content_type = \ContentType\detect($name);

    include_once "$fnsDir/MediaType/detect.php";
    $media_type = \MediaType\detect($name);

    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = 'insert into received_files'
        .' (sender_id_users, sender_username,'
        .' receiver_id_users, content_type, media_type,'
        .' name, size, readable_size)'
        ." values ($sender_id_users, '$sender_username',"
        ." $receiver_id_users, '$content_type', '$media_type',"
        ." '$name', '$size', '$readable_size')";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
