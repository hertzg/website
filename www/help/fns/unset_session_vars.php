<?php

function unset_session_vars () {
    unset(
        $_SESSION['help/feedback/errors'],
        $_SESSION['home/messages']
    );
}
