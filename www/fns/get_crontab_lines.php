<?php

function get_crontab_lines () {
    $scriptsDir = realpath(__DIR__.'/../scripts');
    return [
        '# m h dom mon dow command',
        "  0 1 *   *   *   $scriptsDir/auto-update.php",
        "  0 0 *   *   *   $scriptsDir/delete-old-signins.php",
        "  0 0 *   *   *   $scriptsDir/email-expire-users.php",
        "  0 0 *   *   *   $scriptsDir/expire-deleted-items.php",
        "  0 0 *   *   *   $scriptsDir/expire-unused-users.php",
        "  0 0 *   *   *   $scriptsDir/expire-users.php",
        "  * * *   *   *   $scriptsDir/send-sending-items/index.php",
    ];
}
