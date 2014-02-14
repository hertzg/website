<?php

namespace Tokens;

function remove ($mysqli, $id) {
    mysqli_query($mysqli, "delete from tokens where idtokens = $id");
}
