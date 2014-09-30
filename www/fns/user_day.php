<?php

function user_day ($user) {
    $time = time() + $user->timezone * 60;
    return (int)floor($time / (60 * 60 * 24));
}
