<?php

namespace Tokens;

function delete ($mysqli, $id) {
    mysqli_query($mysqli, "delete from tokens where idtokens = $id");
}
