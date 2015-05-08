<?php

namespace ViewPage;

function create ($mysqli, $user, $bar_chart, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';
    $id = $bar_chart->id;

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../');

    include_once "$fnsDir/format_author.php";
    $author = format_author($bar_chart->insert_time,
        $bar_chart->insert_api_key_name);
    $infoText = "Bar chart created $author.";
    if ($bar_chart->revision) {
        $author = format_author($bar_chart->update_time,
            $bar_chart->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    unset(
        $_SESSION['bar-charts/edit/errors'],
        $_SESSION['bar-charts/edit/values'],
        $_SESSION['bar-charts/errors'],
        $_SESSION['bar-charts/messages']
    );

    $num_bars = $bar_chart->num_bars;
    if ($num_bars) {

        $limit = 5;

        include_once "$fnsDir/BarChartBars/indexLimitOnBarChart.php";
        $bars = \BarChartBars\indexLimitOnBarChart($mysqli, $id, $limit);

        include_once __DIR__.'/../render_bars.php';
        render_bars($bars, $items);

        if ($num_bars > $limit) {
            $items[] = \Page\imageArrowLinkWithDescription('All Bars',
                "$num_bars total.", "../all-bars/?id=$id",
                'bars', ['id' => 'all-bars']);
        }

        $barsContent = join('<div class="hr"></div>', $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $barsContent = \Page\info('No bars');
    }

    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return \Page\tabs(
        [
            [
                'title' => 'Bar Charts',
                'href' => "../#$id",
            ],
        ],
        "Bar Chart #$id",
        \Page\sessionMessages('bar-charts/view/messages')
        .\Form\label('Name', htmlspecialchars($bar_chart->name))
        .\Page\infoText($infoText)
        .create_panel('Bars', $barsContent)
        .optionsPanel($id, $user),
        \Page\newItemButton("../new-bar/?id=$id", 'Bar')
    );

}
