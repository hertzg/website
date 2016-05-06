#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../lib/mysqli.php';

include_once '../fns/Tables/ensureAll.php';
echo Tables\ensureAll($mysqli);

include_once '../fns/write_crontab.php';
write_crontab();

$sql = 'update users set reset_password_key = null,'
    .' reset_password_key_time = null, verify_email_key = null,'
    .' verify_email_key_time = null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'delete from invitations';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
