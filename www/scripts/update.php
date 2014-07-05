<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$content_type = 'content_type varchar(32) character set ascii collate ascii_bin';

$sql = "alter table deleted_files add $content_type not null first";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "alter table files add $content_type not null first";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "alter table received_files add $content_type not null after committed";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "alter table received_folder_files add $content_type not null first";
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
