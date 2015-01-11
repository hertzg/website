<?php

namespace HomePage;

function unsetSessionVars () {
    unset(
        $_SESSION['account/messages'],
        $_SESSION['bookmarks/errors'],
        $_SESSION['bookmarks/messages'],
        $_SESSION['calendar/messages'],
        $_SESSION['contacts/errors'],
        $_SESSION['contacts/messages'],
        $_SESSION['files/errors'],
        $_SESSION['files/id_folders'],
        $_SESSION['files/messages'],
        $_SESSION['help/messages'],
        $_SESSION['home/customize/messages'],
        $_SESSION['notes/errors'],
        $_SESSION['notes/messages'],
        $_SESSION['notifications/in-channel/messages'],
        $_SESSION['notifications/in-subscribed-channel/messages'],
        $_SESSION['notifications/messages'],
        $_SESSION['schedules/errors'],
        $_SESSION['schedules/messages'],
        $_SESSION['tasks/errors'],
        $_SESSION['tasks/messages'],
        $_SESSION['trash/errors'],
        $_SESSION['trash/messages'],
        $_SESSION['wallets/errors'],
        $_SESSION['wallets/messages']
    );
}
