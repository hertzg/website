<?php

namespace Users;

function isVerifyEmailPending ($user) {
    return $user->verify_email_key &&
        $user->verify_email_key_time > time() - 24 * 60 * 60;
}
