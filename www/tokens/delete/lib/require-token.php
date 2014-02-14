<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once __DIR__.'/../../../fns/Tokens/getOnUser.php';
include_once __DIR__.'/../../../lib/mysqli.php';
$token = Tokens\getOnUser($mysqli, $idusers, $id);

if (!$token) {
    include_once __DIR__.'/../../../fns/redirect.php';
    redirect('..');
}

