<?php

function unset_session_vars () {
    unset(
        $_SESSION['notifications/channels/add/errors'],
        $_SESSION['notifications/channels/add/values'],
        $_SESSION['notifications/channels/view/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/messages']
    );
}
