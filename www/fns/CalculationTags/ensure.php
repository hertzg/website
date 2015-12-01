<?php

namespace CalculationTags;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/Calculations/maxLengths.php";
    $maxLengths = \Calculations\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/TagName/column.php";
    return \Table\ensure($mysqli, 'calculation_tags', [
        'expression' => [
            'type' => "varchar($maxLengths[expression])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_calculations' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'tag_name' => \TagName\column(),
        'title' => [
            'type' => "varchar($maxLengths[title])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'update_time' => ['type' => 'bigint(20) unsigned'],
        'value' => ['type' => 'bigint(20) unsigned'],
    ]);

}
