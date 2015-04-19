<?php

function unset_session_vars () {
    unset(
        $_SESSION['contacts/new/errors'],
        $_SESSION['contacts/new/values'],
        $_SESSION['contacts/received/errors'],
        $_SESSION['contacts/received/messages'],
        $_SESSION['contacts/view/messages'],
        $_SESSION['home/messages']
    );
}
