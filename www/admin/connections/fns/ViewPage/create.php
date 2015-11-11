<?php

namespace ViewPage;

function create ($mysqli, $connection, &$scripts) {

    $id = $connection->id;
    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base)
        .compressed_js_script('flexTextarea', $base);

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    $address = htmlspecialchars($connection->address);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $address = preg_replace($regex, '<mark>$0</mark>', $address);
    }

    include_once "$fnsDir/export_date_ago.php";
    $infoText = 'Connection created '
        .export_date_ago($connection->insert_time).'.';
    if ($connection->revision) {
        $infoText .= '<br />Last modified '
            .export_date_ago($connection->update_time).'.';
    }

    $access_time = $connection->access_time;
    if ($access_time === null) $accessed = 'Never';
    else {

        $accessed = export_date_ago($access_time, true);

        $access_remote_address = $connection->access_remote_address;
        if ($access_remote_address !== null) {
            $accessed .= ' from '.htmlspecialchars($access_remote_address);
        }

    }

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/notes.php";
    include_once "$fnsDir/Form/textarea.php";

    $label = 'Their exchange API key';
    $their_exchange_api_key = $connection->their_exchange_api_key;
    if ($their_exchange_api_key === null) {
        $theirKeyItem = \Form\label($label, 'Not set');
    } else {
        $theirKeyItem =
            \Form\textarea('their_exchange_api_key', $label, [
                'value' => $their_exchange_api_key,
                'readonly' => true,
            ])
            .\Form\notes([
                'This should be the value of <code>exchange_api_key</code>'
                .' parameter when we call their exchange API method.',
            ]);
    }

    include_once __DIR__.'/authsPanel.php';
    include_once __DIR__.'/optionsPanel.php';
    include_once "$fnsDir/create_expires_label.php";
    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    include_once "$fnsDir/ItemList/listHref.php";
    include_once "$fnsDir/Page/infoText.php";
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Connections',
                    'href' => \ItemList\listHref()."#$id",
                ],
            ],
            "Connection #$id",
            \Page\sessionMessages('admin/connections/view/messages')
            .\Form\label('Address', $address)
            .'<div class="hr"></div>'
            .create_expires_label($connection->expire_time)
            .'<div class="hr"></div>'
            .$theirKeyItem
            .'<div class="hr"></div>'
            .\Form\textarea('our_exchange_api_key', 'Our exchange API key', [
                'value' => $connection->our_exchange_api_key,
                'readonly' => true,
            ])
            .\Form\notes([
                'This should be the value of <code>exchange_api_key</code>'
                .' parameter when they call our exchange API method.',
            ])
            .'<div class="hr"></div>'
            .\Form\label('Last accessed', $accessed)
            .\Page\infoText($infoText),
            \Page\newItemButton(
                '../new/'.\ItemList\escapedPageQuery(), 'Connection')
        )
        .authsPanel($mysqli, $connection)
        .optionsPanel($id);

}
