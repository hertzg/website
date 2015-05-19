<?php

function unset_session_vars () {
    unset(
        $_SESSION['bar-charts/new/errors'],
        $_SESSION['bar-charts/new/values'],
        $_SESSION['bar-charts/view/messages'],
        $_SESSION['home/messages']
    );
}
