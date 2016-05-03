<?php

function get_git_commit (&$hash, &$tag, &$date) {

    exec('git rev-parse HEAD', $lines);
    $hash = htmlspecialchars($lines[0]);
    unset($lines);

    exec('git describe', $lines);
    if (count($lines) === 1) $tag = htmlspecialchars($lines[0]);
    else $tag = 'Not available';
    unset($lines);

    exec('git show -s --format=%ct', $lines);
    $date = htmlspecialchars($lines[0]);
    unset($lines);

}
