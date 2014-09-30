<?php

namespace ApiKeys;

function getOnUser ($mysqli, $id_users, $id) {
    $sql = "select * from api_keys where id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    $apiKey = mysqli_single_object($mysqli, $sql);
    if ($apiKey && $apiKey->id_users == $id_users) return $apiKey;
}
