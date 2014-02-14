<?php

namespace Tokens;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from tokens where idusers = $idusers");
}
