<?php

namespace Events;

function delete ($mysqli, $id) {
    $mysqli->query("delete from events where id_events = $id");
}
