<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    unset(
        $_SESSION['bar-charts/new/errors'],
        $_SESSION['bar-charts/new/values'],
        $_SESSION['bar-charts/view/messages'],
        $_SESSION['home/messages']
    );

    if ($user->num_bar_charts) {

        $items = [];

        include_once "$fnsDir/BarCharts/indexOnUser.php";
        $barCharts = BarCharts\indexOnUser($mysqli, $user->id_users);

        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($barCharts as $barChart) {
            $id = $barChart->id;
            $items[] = Page\imageArrowLink(htmlspecialchars($barChart->name),
                "{$base}view/?id=$id", 'bar-chart', ['id' => $id]);
        }

        include_once "$fnsDir/Page/imageLink.php";
        $optionsContent =
            '<div id="deleteAllLink">'
                .Page\imageLink('Delete All Bar Charts',
                    "{$base}delete-all/", 'trash-bin')
            .'</div>';

        include_once "$fnsDir/create_panel.php";
        $content =
            join('<div class="hr"></div>', $items)
            .create_panel('Options', $optionsContent);

    } else {
        include_once "$fnsDir/Page/info.php";
        $content = Page\info('No bar charts');
    }

    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../home/#bar-charts",
            ],
        ],
        'Bar Charts',
        Page\sessionErrors('bar-charts/errors')
        .Page\sessionMessages('bar-charts/messages')
        .$content,
        Page\newItemButton("{$base}new/", 'Bar Chart')
    );

}
