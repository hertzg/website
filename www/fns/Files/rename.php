<?php

namespace Files;

function rename ($mysqli, $id, $name, $renameApiKey) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ContentType/detect.php";
    $content_type = \ContentType\detect($name);

    include_once "$fnsDir/MediaType/detect.php";
    $media_type = \MediaType\detect($name);

    $name = $mysqli->real_escape_string($name);
    $rename_time = time();
    if ($renameApiKey === null) {
        $rename_api_key_id = $rename_api_key_name = 'null';
    } else {

        $rename_api_key_id = $renameApiKey->id;

        $keyName = $renameApiKey->name;
        $rename_api_key_name = "'".$mysqli->real_escape_string($keyName)."'";

    }

    $sql = "update files set name = '$name', content_type = '$content_type',"
        ." media_type = '$media_type', rename_time = $rename_time,"
        ." rename_api_key_id = $rename_api_key_id,"
        ." rename_api_key_name = $rename_api_key_name,"
        ." revision = revision + 1 where id_files = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
