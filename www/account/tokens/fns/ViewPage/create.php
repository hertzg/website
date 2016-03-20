<?php

namespace ViewPage;

function create ($mysqli, $token, &$scripts) {

    $id = $token->id;
    $base = '../../../';
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = \Page\imageLink('Delete',
        "../delete/?id=$id", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/export_date_ago.php";
    $accessed = export_date_ago($token->access_time, true);

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base)
        .compressed_js_script('flexTextarea', $base);

    $access_remote_address = $token->access_remote_address;
    if ($access_remote_address !== null) {
        $accessed .= ' from '.htmlspecialchars($access_remote_address);
    }

    unset(
        $_SESSION['account/tokens/errors'],
        $_SESSION['account/tokens/messages']
    );

    include_once __DIR__.'/authsPanel.php';
    include_once "$fnsDir/Page/panel.php";
    include_once "$fnsDir/get_absolute_base.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/infoText.php";
    return
        \Page\create(
            [
                'title' => 'Sessions',
                'href' => "../#$id",
            ],
            "Session #$id",
            \Form\textfield('token_text', 'Identifier', [
                'value' => bin2hex($token->token_text),
                'readonly' => true,
            ])
            .'<div class="hr"></div>'
            .\Form\textarea('user_agent', 'User agent', [
                'value' => $token->user_agent,
                'readonly' => true,
            ])
            .'<div class="hr"></div>'
            .\Form\textarea('link', 'Link to restore', [
                'value' => get_absolute_base().'restore-session/'
                    .'?username='.rawurlencode($token->username)
                    .'&token='.bin2hex($token->token_text),
                'readonly' => true,
            ])
            .'<div class="hr"></div>'
            .\Form\label('Last accessed', $accessed)
            .\Page\infoText('Session created '
                .export_date_ago($token->insert_time).'.')
        )
        .authsPanel($mysqli, $token, $scripts)
        .\Page\panel('Session Options', $deleteLink);

}
