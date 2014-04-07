<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['calendar/new-event/errors'],
        $_SESSION['calendar/new-event/values'],
        $_SESSION['calendar/view-event/messages']
    );
}
