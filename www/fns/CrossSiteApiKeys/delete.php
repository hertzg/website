<?php

namespace CrossSiteApiKeys;

function delete ($mysqli, $id) {
    $sql = "delete from cross_site_api_keys where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
