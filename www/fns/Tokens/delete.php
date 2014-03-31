<?php

namespace Tokens;

function delete ($mysqli, $id) {
    $mysqli->query("delete from tokens where id_tokens = $id");
}
