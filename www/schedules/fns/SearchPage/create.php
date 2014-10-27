<?php

namespace SearchPage;

function create ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_keyword_tag_offset();

    if ($keyword === '') {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    if ($tag === '') {

        include_once "$fnsDir/Schedules/searchOnUser.php";
        $schedules = \Schedules\searchOnUser($mysqli, $id_users, $keyword);

        $filterMessage = '';

        if (count($schedules) > 1) {

            include_once "$fnsDir/ScheduleTags/indexOnUser.php";
            $tags = \ScheduleTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags, [
                    'keyword' => $keyword,
                ]);
            }

        }

        $clearSearchHref = '..';

    } else {

        include_once "$fnsDir/ScheduleTags/searchOnTagName.php";
        $schedules = \ScheduleTags\searchOnTagName($mysqli,
            $id_users, $keyword, $tag);

        $clearHref = '?keyword='.rawurlencode($keyword);
        include_once "$fnsDir/create_clear_filter_bar.php";
        $filterMessage = create_clear_filter_bar($tag, $clearHref);

        $clearSearchHref = '../?tag='.rawurlencode($tag);

    }

    include_once "$fnsDir/SearchForm/content.php";
    $formContent = \SearchForm\content($keyword,
        'Search schedules...', $clearSearchHref);

    include_once "$fnsDir/SearchForm/create.php";
    $items = [\SearchForm\create('./', $formContent)];

    include_once __DIR__.'/renderSchedules.php';
    renderSchedules($schedules, $items, $keyword, $user);

    if (count($schedules) > 1) {

        include_once "$fnsDir/ScheduleTags/indexOnUser.php";
        $tags = \ScheduleTags\indexOnUser($mysqli, $id_users);

        if ($tags) {
            include_once "$fnsDir/create_tag_filter_bar.php";
            $filterMessage = create_tag_filter_bar($tags, [
                'keyword' => $keyword,
            ]);
        }

    }

    include_once __DIR__.'/../unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/createContent.php';
    return createContent($filterMessage, $items, $user);

}
