<?php

namespace Contacts;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from contacts where idusers = $idusers");
}
