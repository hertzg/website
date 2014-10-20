#!/usr/bin/php
<?php

function alter ($mysqli, $table) {
    $mysqli->query("alter table $table change num_edits revision bigint unsigned not null");
}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

alter($mysqli, 'api_keys');
alter($mysqli, 'bookmarks');
alter($mysqli, 'channels');
alter($mysqli, 'connections');
alter($mysqli, 'contacts');
alter($mysqli, 'events');
alter($mysqli, 'notes');
alter($mysqli, 'schedules');
alter($mysqli, 'tasks');

echo "Done\n";
