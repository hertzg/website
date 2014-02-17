<?php

namespace Folders;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from folders where idusers = $idusers");
}
