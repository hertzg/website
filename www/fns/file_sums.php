<?php

function file_sums ($filename, &$md5_sum, &$sha256_sum) {

    $md5_hash = hash_init('md5');
    $sha256_hash = hash_init('sha256');

    $f = fopen($filename, 'r');
    while (!feof($f)) {
        $chunk = fread($f, 1024 * 64);
        hash_update($md5_hash, $chunk);
        hash_update($sha256_hash, $chunk);
    }
    fclose($f);

    $md5_sum = hash_final($md5_hash);
    $sha256_sum = hash_final($sha256_hash);

}
