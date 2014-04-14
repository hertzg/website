<?php

function unset_session_vars () {
    unset(
        $_SESSION['account/messages'],
        $_SESSION['bookmarks/errors'],
        $_SESSION['bookmarks/messages'],
        $_SESSION['calendar/messages'],
        $_SESSION['contacts/errors'],
        $_SESSION['contacts/messages'],
        $_SESSION['files/messages'],
        $_SESSION['help/messages'],
        $_SESSION['home/customize/messages'],
        $_SESSION['notes/errors'],
        $_SESSION['notes/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/messages'],
        $_SESSION['tasks/errors'],
        $_SESSION['tasks/messages']
    );
}
