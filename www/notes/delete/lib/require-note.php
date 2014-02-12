<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once __DIR__.'/../../../fns/Notes/get.php';
include_once __DIR__.'/../../../lib/mysqli.php';
$note = Notes\get($mysqli, $idusers, $id);

if (!$note) {
    include_once __DIR__.'/../../../fns/redirect.php';
    redirect('..');
}
