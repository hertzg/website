<?php

namespace ViewTransactionPage;

function viewContent ($transaction, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../");

    include_once "$fnsDir/format_author.php";
    $author = format_author($transaction->insert_time,
        $transaction->insert_api_key_name);
    $infoText = "Transaction created $author.";
    if ($transaction->revision) {
        $author = format_author($transaction->update_time,
            $transaction->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once "$fnsDir/amount_html.php";
    include_once "$fnsDir/Form/label.php";
    $content = \Form\label('Amount', amount_html($transaction->amount));

    $description = $transaction->description;
    if ($description !== '') {
        $content .=
            '<div class="hr"></div>'
            .\Form\label('Description', htmlspecialchars($description));
    }

    include_once "$fnsDir/Page/infoText.php";
    $content .=
        '<div class="hr"></div>'
        .\Form\label('Balance after', amount_html($transaction->balance_after))
        .\Page\infoText($infoText);

    return $content;

}
