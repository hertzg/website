<?php

include_once 'require-user.php';

include_once __DIR__.'/../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once __DIR__.'/../../fns/Files/get.php';
include_once __DIR__.'/../../lib/mysqli.php';
$file = Files\get($mysqli, $idusers, $id);

if (!$file) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
