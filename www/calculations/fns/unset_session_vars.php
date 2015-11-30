<?php

function unset_session_vars () {
    unset(
        $_SESSION['calculations/new/errors'],
        $_SESSION['calculations/new/values'],
        $_SESSION['calculations/received/errors'],
        $_SESSION['calculations/received/messages'],
        $_SESSION['calculations/view/messages'],
        $_SESSION['home/messages']
    );
}
