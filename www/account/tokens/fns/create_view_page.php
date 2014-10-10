<?php

function create_view_page ($token) {

    $id = $token->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink =
        '<div id="deleteLink">'
            .Page\imageLink('Delete', "../delete/?id=$id", 'trash-bin')
        .'</div>';

    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/date_ago.php";
    include_once "$fnsDir/Form/label.php";
    include_once "$fnsDir/Form/textarea.php";
    include_once "$fnsDir/Form/textfield.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Sessions',
                    'href' => '..',
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
            .Form\label('Last accessed', ucfirst(date_ago($token->access_time)))
        )
        .create_panel('Session Options', $deleteLink);

}
