<?php

namespace Invitations;

function getByKey ($mysqli, $id, $key) {

    include_once __DIR__.'/get.php';
    $invitation = get($mysqli, $id);

    if ($invitation && $invitation->key == $key) return $invitation;

}
