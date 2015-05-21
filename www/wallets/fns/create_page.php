<?php

function create_page ($mysqli, $user, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    $searchForm = false;
    $total = $user->num_wallets;

    if ($total) {

        $items = [];

        include_once "$fnsDir/Paging/requestOffset.php";
        $offset = Paging\requestOffset();

        include_once "$fnsDir/Paging/limit.php";
        $limit = Paging\limit();

        include_once "$fnsDir/check_offset_overflow.php";
        check_offset_overflow($offset, $limit, $total);

        include_once "$fnsDir/Wallets/indexPageOnUser.php";
        $wallets = Wallets\indexPageOnUser($mysqli,
            $user->id_users, $offset, $limit, $total);

        if ($total > 1) {

            include_once "$fnsDir/SearchForm/emptyContent.php";
            $formContent = SearchForm\emptyContent('Search wallets...');

            include_once "$fnsDir/SearchForm/create.php";
            $items[] = SearchForm\create("{$base}search/", $formContent);

            $searchForm = true;

        }

        $params = [];

        include_once __DIR__.'/render_prev_button.php';
        render_prev_button($offset, $limit, $total, $items, $params);

        include_once "$fnsDir/amount_html.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($wallets as $wallet) {
            $id = $wallet->id;
            $items[] = Page\imageArrowLinkWithDescription(
                htmlspecialchars($wallet->name), amount_html($wallet->balance),
                "{$base}view/?id=$id", 'wallet', ['id' => $id]);
        }

        include_once __DIR__.'/render_next_button.php';
        render_next_button($offset, $limit, $total, $items, $params);

        $content = join('<div class="hr"></div>', $items);

    } else {
        include_once "$fnsDir/Page/info.php";
        $content = Page\info('No wallets');
    }

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/create_content.php';
    return create_content($content, $user, $base, $searchForm);

}
