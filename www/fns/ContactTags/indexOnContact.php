<?php

namespace ContactTags;

function indexOnContact ($mysqli, $id_contacts) {
    $sql = 'select * from contact_tags'
        ." where id_contacts = $id_contacts order by tag_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
