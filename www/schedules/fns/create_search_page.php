<?php

function create_search_page ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    if ($keyword === '') {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

    include_once "$fnsDir/Schedules/searchOnUser.php";
    include_once '../../lib/mysqli.php';
    $schedules = Schedules\searchOnUser($mysqli, $user->id_users, $keyword);

    include_once "$fnsDir/SearchForm/content.php";
    $formContent = SearchForm\content($keyword, 'Search schedules...', '..');

    include_once "$fnsDir/SearchForm/create.php";
    $items = [SearchForm\create('./', $formContent)];

    if ($schedules) {

        include_once __DIR__.'/sort_schedules.php';
        sort_schedules($user, $schedules);

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once __DIR__.'/format_days_left.php';
        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($schedules as $schedule) {

            $title = htmlspecialchars($schedule->text);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $description = format_days_left($user, $schedule->days_left);
            $href = '../view/'.ItemList\escapedItemQuery($schedule->id);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, 'schedule');

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No schedules found');
    }

    include_once __DIR__.'/create_options_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../../home/',
                ],
            ],
            'Schedules',
            Page\sessionErrors('schedules/errors')
            .Page\sessionMessages('schedules/messages')
            .join('<div class="hr"></div>', $items)
            .create_options_panel($user, '../'),
            create_new_item_button('Schedule', '../')
        )
        .compressed_js_script('searchForm', '../../');

}
