<?php

function create_received_tab_content ($user) {

    $num_received = $user->num_received_places;

    $num_new = $num_received - $user->num_archived_received_places;
    if ($num_new > 0) {
        if ($num_new == $num_received) $description = "$num_new new.";
        else $description = "$num_new new. $num_received total.";
    } else {
        $description = "$num_received total.";
    }

    include_once __DIR__.'/../../fns/title_and_description.php';
    return title_and_description('Received', $description);

}
