<?php

namespace ReceivedFolderFiles;

function add ($mysqli, $id_received_folders,
    $id_users, $parent_id, $name, $size) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ContentType/detect.php";
    $content_type = \ContentType\detect($name);

    include_once "$fnsDir/MediaType/detect.php";
    $media_type = \MediaType\detect($name);

    $name = $mysqli->real_escape_string($name);

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = 'insert into received_folder_files'
        .' (id_received_folders, id_users, parent_id,'
        .' content_type, media_type, name, size, readable_size)'
        ." values ($id_received_folders, $id_users, $parent_id,"
        ." '$content_type', '$media_type', '$name', $size, '$readable_size')";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
