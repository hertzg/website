<?php

function unset_session_vars () {
    unset(
        $_SESSION['home/messages'],
        $_SESSION['schedules/new/errors'],
        $_SESSION['schedules/new/values'],
        $_SESSION['schedules/view/messages']
    );
}
