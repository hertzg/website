<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['notes/edit/errors'],
        $_SESSION['notes/edit/values'],
        $_SESSION['notes/errors'],
        $_SESSION['notes/messages'],
        $_SESSION['notes/new/errors'],
        $_SESSION['notes/new/values'],
        $_SESSION['notes/send/errors'],
        $_SESSION['notes/send/messages'],
        $_SESSION['notes/send/values'],
        $_SESSION['notes/unlock/errors'],
        $_SESSION['notes/unlock/values']
    );
}
