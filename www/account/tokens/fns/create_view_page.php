<?php

function create_view_page ($token) {

    $id = $token->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/date_ago.php";
    $accessed = date_ago($token->access_time, true);

    $access_remote_address = $token->access_remote_address;
    if ($access_remote_address !== null) {
        $accessed .= ' from '.htmlspecialchars($access_remote_address);
    }

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Sessions',
                    'href' => "../#$id",
                ],
            ],
            "Session #$id",
            Form\textfield('token_text', 'Identifier', [
                'value' => bin2hex($token->token_text),
                'readonly' => true,
            ])
            .'<div class="hr"></div>'
            .Form\textarea('user_agent', 'User agent', [
                'value' => $token->user_agent,
                'readonly' => true,
            ])
            .'<div class="hr"></div>'
            .Form\label('Last accessed', $accessed)
        )
        .create_panel('Session Options', $deleteLink);

}
