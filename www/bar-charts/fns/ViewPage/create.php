<?php

namespace ViewPage;

function create ($mysqli, $user, $bar_chart, &$scripts, &$head) {

    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';
    $id = $bar_chart->id;

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('barChart', $base);

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    $name = htmlspecialchars($bar_chart->name);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $name = preg_replace($regex, '<mark>$0</mark>', $name);
    }

    include_once "$fnsDir/Form/label.php";
    $items = [\Form\label('Name', $name)];

    if ($bar_chart->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags('', json_decode($bar_chart->tags_json));
    }

    include_once "$fnsDir/format_author.php";
    $author = format_author($bar_chart->insert_time,
        $bar_chart->insert_api_key_name);
    $infoText = "Bar chart created $author.";
    if ($bar_chart->revision) {
        $author = format_author($bar_chart->update_time,
            $bar_chart->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/chart.php';
    include_once __DIR__.'/barsPanel.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Bar Charts',
                'href' => \ItemList\listHref()."#$id",
            ],
            "Bar Chart #$id",
            \Page\sessionMessages('bar-charts/view/messages')
            .chart($mysqli, $bar_chart)
            .join('<div class="hr"></div>', $items)
            .\Page\infoText($infoText),
            create_new_item_button('Bar Chart', '../')
        )
        .barsPanel($mysqli, $bar_chart, $scripts)
        .optionsPanel($bar_chart);

}
