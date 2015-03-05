<?php

namespace Files;

function add ($mysqli, $id_users, $id_folders, $name, $size, $insertApiKey) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ContentType/detect.php";
    $content_type = \ContentType\detect($name);

    include_once "$fnsDir/MediaType/detect.php";
    $media_type = \MediaType\detect($name);

    $name = $mysqli->real_escape_string($name);
    $insert_time = $rename_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $keyName = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($keyName)."'";

    }

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = 'insert into files'
        .' (id_users, id_folders, content_type, media_type,'
        .' name, size, readable_size, insert_time, rename_time,'
        .' insert_api_key_id, insert_api_key_name)'
        ." value ($id_users, $id_folders, '$content_type', '$media_type',"
        ." '$name', $size, '$readable_size', $insert_time, $rename_time,"
        ." $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
