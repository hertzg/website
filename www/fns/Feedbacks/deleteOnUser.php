<?php

namespace Feedbacks;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from feedbacks where idusers = $idusers");
}
