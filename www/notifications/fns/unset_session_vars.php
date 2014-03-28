<?php

function unset_session_vars () {
    unset(
        $_SESSION['channels/errors'],
        $_SESSION['channels/messages'],
        $_SESSION['home/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages']
    );
}
