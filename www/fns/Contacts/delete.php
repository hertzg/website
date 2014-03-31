<?php

namespace Contacts;

function delete ($mysqli, $id) {
    $mysqli->query("delete from contacts where id_contacts = $id");
}
