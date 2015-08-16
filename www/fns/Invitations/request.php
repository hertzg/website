<?php

namespace Invitations;

function request () {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/request_strings.php";
    list($note) = request_strings('note');

    include_once "$fnsDir/str_collapse_spaces.php";
    $note = str_collapse_spaces($note);

    return $note;

}
