<?php

function n_times ($n) {
    if ($n == 0) return 'never';
    if ($n == 1) return 'once';
    if ($n == 2) return 'twice';
    return "$n times";
}
