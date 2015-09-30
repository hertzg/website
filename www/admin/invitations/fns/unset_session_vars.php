<?php

function unset_session_vars () {
    unset(
        $_SESSION['admin/invitations/view/messages'],
        $_SESSION['admin/messages']
    );
}
