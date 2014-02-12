<?php

namespace Tasks;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from tasks where idusers = $idusers");
}
