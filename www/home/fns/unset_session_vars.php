<?php

function unset_session_vars () {
    unset(
        $_SESSION['account/messages'],
        $_SESSION['bookmarks/messages'],
        $_SESSION['calendar/messages'],
        $_SESSION['contacts/messages'],
        $_SESSION['customize-home/messages'],
        $_SESSION['files/messages'],
        $_SESSION['help/messages'],
        $_SESSION['notes/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/messages'],
        $_SESSION['tasks/messages']
    );
}
