<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/customize/messages'],
        $_SESSION['home/customize/show-hide/messages']
    );
}
