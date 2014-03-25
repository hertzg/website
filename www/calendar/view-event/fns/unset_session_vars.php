<?php

function unset_session_vars () {
    unset(
        $_SESSION['calendar/edit-event/errors'],
        $_SESSION['calendar/edit-event/values'],
        $_SESSION['calendar/errors'],
        $_SESSION['calendar/messages']
    );
}
