<?php

namespace BarChartTags;

function ensure ($mysqli) {

    $fnsDir = __DIR__.'/..';

    include_once "$fnsDir/BarCharts/maxLengths.php";
    $maxLengths = \BarCharts\maxLengths();

    include_once "$fnsDir/Table/ensure.php";
    include_once "$fnsDir/TagName/column.php";
    include_once "$fnsDir/Tags/column.php";
    include_once "$fnsDir/TagsJson/column.php";
    return \Table\ensure($mysqli, 'bar_chart_tags', [
        'id' => [
            'type' => 'bigint(20) unsigned',
            'primary' => true,
        ],
        'id_bar_charts' => ['type' => 'bigint(20) unsigned'],
        'id_users' => ['type' => 'bigint(20) unsigned'],
        'insert_time' => ['type' => 'bigint(20) unsigned'],
        'name' => [
            'type' => "varchar($maxLengths[name])",
            'characterSet' => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
        'num_tags' => ['type' => 'tinyint(3) unsigned'],
        'tags' => \Tags\column(),
        'tags_json' => \TagsJson\column(),
        'tag_name' => \TagName\column(),
        'update_time' => ['type' => 'bigint(20) unsigned'],
    ]);

}
