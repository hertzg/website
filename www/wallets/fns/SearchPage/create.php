<?php

namespace SearchPage;

function create ($mysqli, $user, &$scripts) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_valid_keyword_tag_offset.php";
    request_valid_keyword_tag_offset($keyword,
        $tag, $offset, $includes, $excludes);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('searchForm', '../../');

    include_once "$fnsDir/Paging/limit.php";
    $limit = \Paging\limit();

    include_once "$fnsDir/Wallets/searchPage.php";
    $wallets = \Wallets\searchPage($mysqli, $user->id_users, $includes,
        $excludes, $offset, $limit, $total, $user->wallets_order_by);

    include_once "$fnsDir/SearchForm/content.php";
    $formContent = \SearchForm\content($keyword, 'Search wallet...', '..');

    include_once "$fnsDir/SearchForm/create.php";
    $items = [\SearchForm\create('./', $formContent)];

    $params = ['keyword' => $keyword];
    if ($offset) $params['offset'] = $offset;

    include_once "$fnsDir/check_offset_overflow.php";
    check_offset_overflow($offset, $limit, $total, $params);

    include_once __DIR__.'/../render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/renderWallets.php';
    renderWallets($wallets, $items, $params, $includes);

    include_once __DIR__.'/../render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

    include_once __DIR__.'/../unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/../create_options_panel.php';
    include_once __DIR__.'/../sort_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Home',
                'href' => '../../search/?keyword='.rawurlencode($keyword),
            ],
            'Wallets',
            \Page\sessionMessages('wallets/messages')
            .join('<div class="hr"></div>', $items),
            create_new_item_button('Wallet', '../')
        )
        .sort_panel($user, $total, '../')
        .create_options_panel($user, '../');

}
