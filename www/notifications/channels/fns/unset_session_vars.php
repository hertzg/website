<?php

function unset_session_vars () {
    unset(
        $_SESSION['channels/add/errors'],
        $_SESSION['channels/add/values'],
        $_SESSION['channels/view/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/messages']
    );
}
