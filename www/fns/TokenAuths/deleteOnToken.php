<?php

namespace TokenAuths;

function deleteOnToken ($mysqli, $id_tokens) {
    $sql = "delete from token_auths where id_tokens = $id_tokens";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
