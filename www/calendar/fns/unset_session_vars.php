<?php

function unset_session_vars () {
    unset(
        $_SESSION['calendar/all-events/errors'],
        $_SESSION['calendar/all-events/messages'],
        $_SESSION['calendar/jump-to/errors'],
        $_SESSION['calendar/new-event/errors'],
        $_SESSION['calendar/new-event/values'],
        $_SESSION['calendar/view-event/messages'],
        $_SESSION['contacts/view/messages'],
        $_SESSION['home/messages'],
        $_SESSION['tasks/view/messages']
    );
}
