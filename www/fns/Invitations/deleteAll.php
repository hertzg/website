<?php

namespace Invitations;

function deleteAll ($mysqli) {
    $mysqli->query('delete from invitations') || trigger_error($mysqli->error);
}
