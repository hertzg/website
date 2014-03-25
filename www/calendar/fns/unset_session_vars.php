<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['calendar/add-event/errors'],
        $_SESSION['calendar/add-event/values'],
        $_SESSION['calendar/view-event/messages']
    );
}
