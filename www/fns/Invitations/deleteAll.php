<?php

namespace Invitations;

function deleteAll () {
    $mysqli->query('delete from invitations') || trigger_error($mysqli->error);
}
