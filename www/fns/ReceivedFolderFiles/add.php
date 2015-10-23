<?php

namespace ReceivedFolderFiles;

function add ($mysqli, $id_received_folders,
    $received_folder_name, $id_users, $parent_id,
    $name, $size, $md5_sum, $sha256_sum) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ContentType/detect.php";
    $content_type = \ContentType\detect($name);

    include_once "$fnsDir/MediaType/detect.php";
    $media_type = \MediaType\detect($name);

    $received_folder_name = $mysqli->real_escape_string($received_folder_name);
    $name = $mysqli->real_escape_string($name);

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = 'insert into received_folder_files'
        .' (id_received_folders, received_folder_name,'
        .' id_users, parent_id, content_type, media_type,'
        .' name, size, readable_size, hashes_computed, md5_sum, sha256_sum)'
        ." values ($id_received_folders, '$received_folder_name',"
        ." $id_users, $parent_id, '$content_type', '$media_type',"
        ." '$name', $size, '$readable_size', 1, '$md5_sum', '$sha256_sum')";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
