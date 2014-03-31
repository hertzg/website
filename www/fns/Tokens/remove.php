<?php

namespace Tokens;

function remove ($mysqli, $id) {
    $mysqli->query("delete from tokens where id = $id");
}
