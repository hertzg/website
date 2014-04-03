<?php

namespace Contacts;

function setFavorite ($mysqli, $id, $favorite) {
    $favorite = $favorite ? '1' : '0';
    $sql = "update contacts set favorite = $favorite where id_contacts = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
