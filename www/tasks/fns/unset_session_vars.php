<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/index_messages'],
        $_SESSION['tasks/new/index_errors'],
        $_SESSION['tasks/new/index_lastpost'],
        $_SESSION['tasks/view/index_messages']
    );
}
