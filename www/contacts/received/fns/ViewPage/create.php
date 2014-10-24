<?php

namespace ViewPage;

function create ($receivedContact) {

    $id = $receivedContact->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/Form/label.php";
    $items = [
        \Form\label('Full name', htmlspecialchars($receivedContact->full_name)),
    ];

    $alias = $receivedContact->alias;
    if ($alias !== '') {
        $items[] = \Form\label('Alias', htmlspecialchars($alias));
    }

    $address = $receivedContact->address;
    if ($address !== '') {
        $items[] = \Form\label('Address', htmlspecialchars($address));
    }

    $email = $receivedContact->email;
    if ($email !== '') {
        $escapedEmail = htmlspecialchars($email);
        $href = "mailto:$escapedEmail";
        include_once "$fnsDir/Form/link.php";
        $items[] = \Form\link('Email', $escapedEmail, $href, 'mail');
    }

    include_once __DIR__.'/../../../fns/render_phone_number.php';
    render_phone_number('Phone 1', $receivedContact->phone1, $items);
    render_phone_number('Phone 2', $receivedContact->phone2, $items);

    include_once __DIR__.'/../../../fns/render_birthday.php';
    render_birthday($receivedContact->birthday_time, $items, '../');

    $username = $receivedContact->username;
    if ($username !== '') {
        $items[] = \Form\label('Zvini username', htmlspecialchars($username));
    }

    $timezone = $receivedContact->timezone;
    if ($timezone !== null) {
        include_once "$fnsDir/Form/timezoneLabel.php";
        $items[] = \Form\timezoneLabel($timezone);
    }

    $tags = $receivedContact->tags;
    if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

    $notes = $receivedContact->notes;
    if ($notes !== '') {
        $items[] = \Form\label('Notes', nl2br(htmlspecialchars($notes)));
    }

    include_once "$fnsDir/date_ago.php";
    include_once "$fnsDir/Page/infoText.php";
    $infoText = \Page\infoText(
        '<div>'
            .($receivedContact->favorite ? 'Favorite' : 'Regular').' contact.'
        .'</div>'
        .'<div>'
            .'Contact received '.date_ago($receivedContact->insert_time).'.'
        .'</div>'
    );

    include_once __DIR__.'/createContent.php';
    return createContent($receivedContact, $infoText, $items);

}
