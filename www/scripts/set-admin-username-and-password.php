#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';

if (count($argv) !== 3) {
    echo "Usage:\n"
        ." ./set-admin-username-and-password.php <username> <password>\n";
    exit;
}

include_once '../fns/Password/hash.php';
list($hash, $salt, $sha512_hash, $sha512_key) = Password\hash($argv[2]);

include_once '../fns/Admin/set.php';
Admin\set($argv[1], $hash, $salt, $sha512_hash, $sha512_key);
