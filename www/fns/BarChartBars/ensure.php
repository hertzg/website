<?php

namespace BarChartBars;

function ensure ($mysqli) {

    include_once __DIR__.'/maxLengths.php';
    $maxLengths = maxLengths();

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/ApiKeyName/column.php";
    $apiKeyNameColumn = \ApiKeyName\column(true);

    include_once "$fnsDir/Table/ensure.php";
    return \Table\ensure($mysqli, 'bar_chart_bars', [
        'deleted' => ['type' => 'tinyint(3) unsigned'],
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'id_bar_charts' => ['type' => 'bigint(20) unsigned'],
        'insert_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'insert_api_key_name' => $apiKeyNameColumn,
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'label' => [
            'type' => "varchar($maxLengths[label])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'revision' => ['type' => 'bigint(20) unsigned'],
        'update_api_key_id' => [
            'type' => 'bigint(20) unsigned',
            'nullable' => true,
        ],
        'update_api_key_name' => $apiKeyNameColumn,
        'update_time' => ['type' => 'bigint(20) unsigned'],
        'value' => ['type' => 'bigint(20)'],
    ]);

}