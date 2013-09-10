<?php

include_once 'require-user.php';
include_once __DIR__.'/../../fns/request_strings.php';
include_once __DIR__.'/../../classes/Folders.php';
list($idfolders) = request_strings('idfolders');
$idfolders = abs((int)$idfolders);
$folder = Folders::get($idusers, $idfolders);
if (!$folder) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
