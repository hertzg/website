<?php

namespace ContactTags;

function setContactFavorite ($mysqli, $id_contacts, $favorite) {
    $favorite = $favorite ? '1' : '0';
    $sql = "update contact_tags set favorite = $favorite"
        ." where id_contacts = $id_contacts";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
