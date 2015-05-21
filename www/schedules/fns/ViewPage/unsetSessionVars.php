<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['schedules/edit/errors'],
        $_SESSION['schedules/edit/values'],
        $_SESSION['schedules/errors'],
        $_SESSION['schedules/messages']
    );
}
