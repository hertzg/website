<?php

function unset_session_vars () {
    unset(
        $_SESSION['contacts/edit/errors'],
        $_SESSION['contacts/edit/values'],
        $_SESSION['contacts/errors'],
        $_SESSION['contacts/messages'],
        $_SESSION['contacts/send/errors'],
        $_SESSION['contacts/send/values']
    );
}
