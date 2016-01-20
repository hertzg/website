<?php

namespace ContactRevisions;

function indexOnContact ($mysqli, $id_contacts) {
    $sql = 'select * from contact_revisions'
        ." where id_contacts = $id_contacts order by insert_time desc";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
