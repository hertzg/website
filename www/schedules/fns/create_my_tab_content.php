<?php

function create_my_tab_content ($user) {
    $num_schedules = $user->num_schedules;
    if ($num_schedules) {
        include_once __DIR__.'/../../fns/title_and_description.php';
        return title_and_description('My', "$num_schedules total.");
    }
    return 'My';
}
