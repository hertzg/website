<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
include_once __DIR__.'/../../../classes/Channels.php';
list($id) = request_strings('id');
$id = abs((int)$id);
$channel = Channels::get($idusers, $id);
if (!$channel) {
    include_once __DIR__.'/../../../fns/redirect.php';
    redirect('..');
}
