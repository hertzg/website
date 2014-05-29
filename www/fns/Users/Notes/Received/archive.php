<?php

namespace Users\Notes\Received;

function archive ($mysqli, $receivedNote) {
    include_once __DIR__.'/../../../ReceivedNotes/setArchived.php';
    \ReceivedNotes\setArchived($mysqli, $receivedNote->id, true);
}
