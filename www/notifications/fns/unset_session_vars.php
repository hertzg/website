<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['notifications/channels/errors'],
        $_SESSION['notifications/channels/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/subscribed-channels/messages']
    );
}
