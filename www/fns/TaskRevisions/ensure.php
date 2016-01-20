<?php

namespace TaskRevisions;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Tasks/maxLengths.php";
    $maxLengths = \Tasks\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/Tags/column.php";
    return \Table\ensure($mysqli, 'task_revisions', [
        'deadline_time' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'deleted' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_tasks' => [
            'type' => 'bigint(20) unsigned',
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'tags' => \Tags\column(),
        'text' => [
            'type' => "varchar($maxLengths[text])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'title' => [
            'type' => "varchar($maxLengths[title])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'top_priority' => ['type' => 'tinyint(3) unsigned'],
    ]);

}
