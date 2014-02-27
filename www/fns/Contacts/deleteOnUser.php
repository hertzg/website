<?php

namespace Contacts;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from contacts where idusers = $idusers");
}
