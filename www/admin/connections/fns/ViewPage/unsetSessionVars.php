<?php

namespace ViewPage;

function unsetSessionVars () {
    unset(
        $_SESSION['admin/connections/edit/errors'],
        $_SESSION['admin/connections/edit/values'],
        $_SESSION['admin/connections/errors'],
        $_SESSION['admin/connections/messages'],
        $_SESSION['admin/connections/new/errors'],
        $_SESSION['admin/connections/new/values']
    );
}
