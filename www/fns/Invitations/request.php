<?php

namespace Invitations;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($note) = request_strings('note');

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    include_once "$fnsDir/str_collapse_spaces.php";
    $note = str_collapse_spaces($note);
    $note = mb_substr($note, 0, $maxLengths['note'], 'UTF-8');

    return $note;

}
