<?php

namespace Users\Schedules;

function invalidateIfNeeded ($mysqli, &$user, $offset) {
    if ($offset == 0 || $offset == 1) {
        if ($user->schedules_check_day) {
            $user->schedules_check_day = 0;
            include_once __DIR__.'/invalidate.php';
            invalidate($mysqli, $user->id_users);
        }
    }
}
