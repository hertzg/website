<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/customize/reorder/messages'],
        $_SESSION['home/customize/show-hide/messages'],
        $_SESSION['home/messages']
    );
}
