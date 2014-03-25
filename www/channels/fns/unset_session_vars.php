<?php

function unset_session_vars () {
    unset(
        $_SESSION['channels/add/errors'],
        $_SESSION['channels/add/values'],
        $_SESSION['channels/hview/messages'],
        $_SESSION['notifications/messages']
    );
}
