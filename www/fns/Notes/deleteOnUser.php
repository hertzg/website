<?php

namespace Notes;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from notes where idusers = $idusers");
}
