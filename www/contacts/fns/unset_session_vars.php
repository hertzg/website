<?php

function unset_session_vars () {
    unset(
        $_SESSION['contacts/new/index_errors'],
        $_SESSION['contacts/new/index_values'],
        $_SESSION['contacts/view/index_messages'],
        $_SESSION['home/index_messages']
    );
}
