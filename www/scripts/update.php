<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$mysqli->query('alter table notifications change notification_text text text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL') || trigger_error($mysqli->error);

$mysqli->query('alter table feedbacks change feedbacktext text text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL after insert_time') || trigger_error($mysqli->error);

echo "Done\n";
