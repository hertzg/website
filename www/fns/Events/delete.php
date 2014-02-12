<?php

namespace Events;

function delete ($mysqli, $id) {
    mysqli_query($mysqli, "delete from events where idevents = $id");
}
