<?php

namespace Users\DeletedItems;

function deleteOnUser ($mysqli, $id_users) {
    include_once __DIR__.'/../../DeletedItems/deleteOnUser.php';
    \DeletedItems\deleteOnUser($mysqli, $id_users);
}
