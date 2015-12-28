<?php

namespace ViewPage;

function create ($mysqli, $user, $wallet, &$scripts, &$head) {

    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';
    $id = $wallet->id;
    $income = $wallet->income;
    $expense = $wallet->expense;

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base);

    $head = '<link rel="stylesheet" type="text/css" href="../view.css?1" />';

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    $name = htmlspecialchars($wallet->name);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $name = preg_replace($regex, '<mark>$0</mark>', $name);
    }

    include_once "$fnsDir/format_author.php";
    $author = format_author($wallet->insert_time, $wallet->insert_api_key_name);
    $infoText = "Wallet created $author.";
    if ($wallet->revision) {
        $author = format_author($wallet->update_time,
            $wallet->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    $days = (time() - $wallet->insert_time) / (60 * 60 * 24);
    if ($days < 1) $days = 1;

    include_once "$fnsDir/amount_html.php";
    $income = amount_html($income).' ('.amount_html($income / $days).' daily)';
    $expense = amount_html($expense)
        .' ('.amount_html($expense / $days).' daily)';

    include_once __DIR__.'/cashflowPanel.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once __DIR__.'/transactionsPanel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return \Page\create(
        [
            'title' => 'Wallets',
            'href' => \ItemList\listHref()."#$id",
        ],
        "Wallet #$id",
        \Page\sessionErrors('wallets/view/errors')
        .\Page\sessionMessages('wallets/view/messages')
        .\Form\label('Name', $name)
        .'<div class="hr"></div>'
        .\Form\label('Income', $income)
        .'<div class="hr"></div>'
        .\Form\label('Expense', $expense)
        .'<div class="hr"></div>'
        .\Form\label('Balance', amount_html($wallet->balance))
        .\Page\infoText($infoText)
        .cashflowPanel($mysqli, $user, $wallet)
        .transactionsPanel($mysqli, $wallet, $scripts)
        .optionsPanel($wallet, $user),
        create_new_item_button('Wallet', '../')
    );

}
