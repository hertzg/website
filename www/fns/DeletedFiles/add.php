<?php

namespace DeletedFiles;

function add ($mysqli, $id_deleted_items, $id_files,
    $id_folders, $id_users, $content_type, $media_type,
    $name, $size, $hashes_computed, $md5_sum, $sha256_sum,
    $insert_time, $rename_time, $content_revision, $revision) {

    $name = $mysqli->real_escape_string($name);
    $hashes_computed = $hashes_computed ? '1' : '0';

    include_once __DIR__.'/../bytestr.php';
    $readable_size = bytestr($size);

    $sql = 'insert into deleted_files'
        .' (id_deleted_items, id_files, id_folders, id_users,'
        .' content_type, media_type, name, size, hashes_computed,'
        .' md5_sum, sha256_sum, readable_size, insert_time,'
        .' rename_time, content_revision, revision)'
        ." values ($id_deleted_items, $id_files, $id_folders, $id_users,"
        ." '$content_type', '$media_type', '$name', $size, $hashes_computed,"
        ." '$md5_sum', '$sha256_sum', '$readable_size', $insert_time,"
        ." $rename_time, $content_revision, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
