<?php

namespace ContactTags;

function deleteOnContact ($mysqli, $id_contacts) {
    $mysqli->query("delete from contact_tags where id_contacts = $id_contacts");
}
