<?php

function write_crontab () {
    include_once __DIR__.'/get_crontab_lines.php';
    include_once __DIR__.'/Crontab/ensureLines.php';
    return Crontab\ensureLines(get_crontab_lines());
}
