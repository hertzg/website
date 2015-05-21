<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['bar-charts/all-bars/messages'],
        $_SESSION['bar-charts/edit/errors'],
        $_SESSION['bar-charts/edit/values'],
        $_SESSION['bar-charts/errors'],
        $_SESSION['bar-charts/messages'],
        $_SESSION['bar-charts/new-bar/errors'],
        $_SESSION['bar-charts/new-bar/values'],
        $_SESSION['bar-charts/view-bar/messages']
    );
}
