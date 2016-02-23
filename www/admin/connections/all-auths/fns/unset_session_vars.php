<?php

function unset_session_vars () {
    unset(
        $_SESSION['admin/connections/view/errors'],
        $_SESSION['admin/connections/view/messages']
    );
}
