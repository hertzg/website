<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['contacts/edit/errors'],
        $_SESSION['contacts/edit/values'],
        $_SESSION['contacts/errors'],
        $_SESSION['contacts/messages'],
        $_SESSION['contacts/new/errors'],
        $_SESSION['contacts/new/values'],
        $_SESSION['contacts/photo/edit/errors'],
        $_SESSION['contacts/send/errors'],
        $_SESSION['contacts/send/messages'],
        $_SESSION['contacts/send/values']
    );
}
