<?php

include_once 'require-user.php';
include_once __DIR__.'/../../fns/request_strings.php';
include_once __DIR__.'/../../classes/Files.php';
list($id) = request_strings('id');
$id = abs((int)$id);
$file = Files::get($idusers, $id);
if (!$file) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
