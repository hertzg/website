<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_keyword_tag_offset();

    if ($tag === '') {

        $filterMessage = '';

        include_once "$fnsDir/Schedules/indexOnUser.php";
        $schedules = Schedules\indexOnUser($mysqli, $id_users);

        if (count($schedules) > 1) {

            include_once "$fnsDir/ScheduleTags/indexOnUser.php";
            $tags = \ScheduleTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags, []);
            }

        }

    } else {

        include_once "$fnsDir/create_clear_filter_bar.php";
        $filterMessage = create_clear_filter_bar($tag, "$base./");

        include_once "$fnsDir/ScheduleTags/indexOnTagName.php";
        $schedules = ScheduleTags\indexOnTagName($mysqli, $id_users, $tag);

    }

    $scripts = '';

    $items = [];
    if ($schedules) {

        if (count($schedules) > 1) {

            include_once "$fnsDir/SearchForm/emptyContent.php";
            $formContent = SearchForm\emptyContent('Search schedules...');

            if ($tag !== '') {
                include_once "$fnsDir/Form/hidden.php";
                $formContent .= Form\hidden('tag', $tag);
            }

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = SearchForm\create("{$base}search/", $formContent);

            include_once "$fnsDir/compressed_js_script.php";
            $scripts = compressed_js_script('searchForm', "$base../");

        }

        include_once __DIR__.'/sort_schedules.php';
        sort_schedules($user, $schedules);

        include_once __DIR__.'/format_days_left.php';
        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($schedules as $schedule) {
            $title = htmlspecialchars($schedule->text);
            $description = format_days_left($user, $schedule->days_left);
            $href = "{$base}view/".ItemList\escapedItemQuery($schedule->id);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, 'schedule');
        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No schedules');
    }

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/create_content.php';
    return create_content($user, $filterMessage, $items, $base, $scripts);

}
