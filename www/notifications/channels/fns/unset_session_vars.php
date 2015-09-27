<?php

function unset_session_vars () {
    unset(
        $_SESSION['notifications/channels/new/errors'],
        $_SESSION['notifications/channels/new/values'],
        $_SESSION['notifications/channels/view/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/messages']
    );
}
