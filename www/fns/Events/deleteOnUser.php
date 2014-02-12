<?php

namespace Events;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from events where idusers = $idusers");
}
