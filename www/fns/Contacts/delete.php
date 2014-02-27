<?php

namespace Contacts;

function delete ($mysqli, $id) {
    $mysqli->query("delete from contacts where idcontacts = $id");
}
