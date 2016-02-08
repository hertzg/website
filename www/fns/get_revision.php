<?php

function get_revision ($key) {
    static $revisions;
    if ($revisions === null) {
        include_once __DIR__.'/get_revisions.php';
        $revisions = get_revisions();
    }
    return $revisions[$key];
}
