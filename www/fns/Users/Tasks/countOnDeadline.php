<?php

namespace Users\Tasks;

function countOnDeadline ($mysqli, $user, $deadline_time) {

    if (!$user->num_tasks) return 0;

    include_once __DIR__.'/../../Tasks/countOnUserAndDeadline.php';
    return \Tasks\countOnUserAndDeadline($mysqli,
        $user->id_users, $deadline_time);

}
