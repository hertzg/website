<?php

namespace Files;

function addDeleted ($mysqli, $id, $id_users,
    $id_folders, $content_type, $media_type, $name,
    $size, $hashes_computed, $md5_sum, $sha256_sum,
    $insert_time, $rename_time, $content_revision, $revision) {

    $name = $mysqli->real_escape_string($name);
    $hashes_computed = $hashes_computed ? '1' : '0';

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = 'insert into files'
        .' (id_files, id_users, id_folders, content_type,'
        .' media_type, name, size, readable_size,'
        .' hashes_computed, md5_sum, sha256_sum, insert_time,'
        .' rename_time, content_revision, revision)'
        ." value ($id, $id_users, $id_folders, '$content_type',"
        ." '$media_type', '$name', $size, '$readable_size',"
        ." $hashes_computed, '$md5_sum', '$sha256_sum', $insert_time,"
        ." $rename_time, $content_revision, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
