<?php

include_once 'require-user.php';

include_once __DIR__.'/../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once __DIR__.'/../../fns/Channels/get.php';
include_once __DIR__.'/../../lib/mysqli.php';
$channel = Channels\get($mysqli, $idusers, $id);

if (!$channel) {
    include_once __DIR__.'/../../fns/redirect.php';
    redirect();
}
