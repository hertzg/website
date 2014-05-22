<?php

namespace Page;

function itemSendForm ($mysqli, $id_users, $username, array $params = []) {

    include_once __DIR__.'/../Form/hidden.php';
    $hiddens = '';
    foreach ($params as $key => $value) {
        $hiddens .= \Form\hidden($key, $value);
    }

    include_once __DIR__.'/../Form/button.php';
    include_once __DIR__.'/../Form/textfield.php';
    include_once __DIR__.'/../Username/maxLength.php';
    $html =
        '<form action="submit.php" method="post">'
            .\Form\textfield('username', 'Zvini username', [
                'value' => $username,
                'maxlength' => \Username\maxLength(),
                'required' => true,
                'autofocus' => true,
            ])
            .'<div class="hr"></div>'
            .\Form\button('Send')
            .$hiddens
        .'</form>';

    include_once __DIR__.'/../Contacts/indexWithUsernameOnUser.php';
    $contacts = \Contacts\indexWithUsernameOnUser($mysqli, $id_users);

    if ($contacts) {

        $items = [];
        include_once __DIR__.'/imageLinkWithDescription.php';
        foreach ($contacts as $contact) {

            $contactUsername = $contact->username;
            $title = htmlspecialchars($contact->full_name);
            $description = 'Username: '.htmlspecialchars($contactUsername);
            $params['username'] = $contactUsername;
            $href = 'submit.php?'.htmlspecialchars(http_build_query($params));

            if ($contact->favorite) $icon = 'favorite-contact';
            else $icon = 'contact';

            $items[] = imageLinkWithDescription($title,
                $description, $href, $icon);

        }

        $content = join('<div class="hr"></div>', $items);

        include_once __DIR__.'/../create_panel.php';
        $html .= create_panel('Select from Contacts', $content);

    }

    return $html;

}
