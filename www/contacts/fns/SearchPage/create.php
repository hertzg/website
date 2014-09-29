<?php

namespace SearchPage;

function create ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../fns';
    $id_users = $user->id_users;

    include_once "$fnsDir/request_valid_keyword_tag_offset.php";
    list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

    $searchAction = './';
    $searchPlaceholder = 'Search contacts...';

    $items = [];

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/SearchForm/content.php";
    include_once "$fnsDir/SearchForm/create.php";

    if ($tag === '') {

        $filterMessage = '';

        include_once "$fnsDir/Contacts/searchPage.php";
        $contacts = \Contacts\searchPage($mysqli,
            $id_users, $keyword, $offset, $limit, $total);

        $formContent = \SearchForm\content($keyword, $searchPlaceholder, '..');
        $items[] = \SearchForm\create($searchAction, $formContent);

        if ($total > 1) {

            include_once "$fnsDir/ContactTags/indexOnUser.php";
            $tags = \ContactTags\indexOnUser($mysqli, $id_users);

            if ($tags) {
                include_once "$fnsDir/create_tag_filter_bar.php";
                $filterMessage = create_tag_filter_bar($tags, [
                    'keyword' => $keyword,
                ]);
            }

        }

    } else {

        include_once "$fnsDir/ContactTags/searchOnTagName.php";
        $contacts = \ContactTags\searchOnTagName($mysqli,
            $id_users, $keyword, $tag, $offset, $limit, $total);

        include_once "$fnsDir/Form/hidden.php";
        $clearHref = '../?tag='.rawurlencode($tag);
        $formContent =
            \SearchForm\content($keyword, $searchPlaceholder, $clearHref)
            .\Form\hidden('tag', $tag);
        $items[] = \SearchForm\create($searchAction, $formContent);

        $clearHref = '?'.htmlspecialchars(
            http_build_query(['keyword' => $keyword])
        );
        include_once "$fnsDir/create_clear_filter_bar.php";
        $filterMessage = create_clear_filter_bar($tag, $clearHref);

    }

    include_once __DIR__.'/renderPrevButton.php';
    renderPrevButton($offset, $limit, $total, $items, $keyword, $tag);

    $params = [];
    if ($keyword !== '') $params['keyword'] = $keyword;
    if ($tag !== '') $params['tag'] = $tag;
    if ($offset) $params['offset'] = $offset;
    include_once __DIR__.'/renderContacts.php';
    renderContacts($contacts, $items, $params, $keyword);

    include_once __DIR__.'/renderNextButton.php';
    renderNextButton($offset, $limit, $total, $items, $keyword, $tag);

    include_once __DIR__.'/../unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/createContent.php';
    return createContent($user, $filterMessage, $items);

}
