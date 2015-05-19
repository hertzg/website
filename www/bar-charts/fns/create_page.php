<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    $total = $user->num_bar_charts;

    if ($total) {

        $items = [];

        include_once "$fnsDir/Paging/requestOffset.php";
        $offset = Paging\requestOffset();

        include_once "$fnsDir/Paging/limit.php";
        $limit = Paging\limit();

        include_once "$fnsDir/check_offset_overflow.php";
        check_offset_overflow($offset, $limit, $total);

        include_once "$fnsDir/BarCharts/indexPageOnUser.php";
        $barCharts = BarCharts\indexPageOnUser($mysqli,
            $user->id_users, $offset, $limit, $total);

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit, $total, $items);

        include_once "$fnsDir/Page/imageArrowLink.php";
        foreach ($barCharts as $barChart) {
            $id = $barChart->id;
            $items[] = Page\imageArrowLink(htmlspecialchars($barChart->name),
                "{$base}view/?id=$id", 'bar-chart', ['id' => $id]);
        }

        include_once __DIR__.'/render_next_button.php';
        render_next_button($offset, $limit, $total, $items);

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

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

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
