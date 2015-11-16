<?php

namespace CrossSiteApiKeys;

function deleteOlder ($mysqli, $insert_time) {
    $sql = 'delete from cross_site_api_keys'
        ." where insert_time < $insert_time";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
