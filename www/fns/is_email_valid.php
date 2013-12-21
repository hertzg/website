<?php

function is_email_valid ($email) {
    return preg_match(
        "/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*[a-z0-9]\.[a-z.]+$/",
        $email
    );
}
