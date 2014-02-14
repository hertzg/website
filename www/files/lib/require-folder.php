<?php

include_once 'require-user.php';

include_once __DIR__.'/../../fns/request_strings.php';
list($idfolders) = request_strings('idfolders');

$idfolders = abs((int)$idfolders);

include_once __DIR__.'/../../fns/Folders/get.php';
include_once __DIR__.'/../../lib/mysqli.php';
$folder = Folders\get($mysqli, $idusers, $idfolders);

if (!$folder) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
