<?php

namespace Events;

function delete ($mysqli, $id) {
    $mysqli->query("delete from events where idevents = $id");
}
