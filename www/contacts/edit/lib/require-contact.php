<?php

include_once __DIR__.'/../../../fns/require_user.php';
require_user('../../');

include_once __DIR__.'/../../../fns/request_strings.php';
list($id) = request_strings('id');

$id = abs((int)$id);

include_once __DIR__.'/../../../classes/Contacts.php';
$contact = Contacts::get($idusers, $id);

if (!$contact) {
    include_once __DIR__.'/../../../fns/redirect.php';
    redirect();
}
