<?php

namespace Calculations;

function getOnUser ($mysqli, $id_users, $id) {
    include_once __DIR__.'/get.php';
    $calculation = get($mysqli, $id);
    if ($calculation && $calculation->id_users == $id_users) {
        return $calculation;
    }
}
