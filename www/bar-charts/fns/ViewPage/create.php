<?php

namespace ViewPage;

function create ($mysqli, $user, $bar_chart, &$scripts, &$head) {

    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';
    $id = $bar_chart->id;

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('barChart', $base)
        .compressed_css_link('newItemMenu', $base);

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    $name = htmlspecialchars($bar_chart->name);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $replace = '<mark>$0</mark>';
        $name = preg_replace($regex, $replace, $name);
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
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemMenu.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'Bar Charts',
                'href' => \ItemList\listHref()."#$id",
            ],
        ],
        "Bar Chart #$id",
        \Page\sessionMessages('bar-charts/view/messages')
        .chart($mysqli, $bar_chart)
        .\Form\label('Name', $name)
        .\Page\infoText($infoText)
        .barsPanel($mysqli, $bar_chart)
        .optionsPanel($bar_chart),
        \Page\newItemMenu(
            \Page\imageArrowLink('Bar',
                '../new-bar/'.\ItemList\escapedItemQuery($id), 'create-bar')
            .'<div class="hr"></div>'
            .\Page\imageArrowLink('Bar Chart',
                '../new/'.\ItemList\escapedPageQuery(), 'create-bar-chart')
        )
    );

}
