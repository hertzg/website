<?php

namespace ViewPage;

function create ($user, $receivedContact, &$head, &$scripts) {

    $id = $receivedContact->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', '../../../');

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

    include_once __DIR__.'/../../../fns/render_emails.php';
    render_emails($receivedContact, $items);

    include_once __DIR__.'/../../../fns/render_phone_numbers.php';
    render_phone_numbers($receivedContact, $items);

    include_once __DIR__.'/../../../fns/render_birthday.php';
    render_birthday($user,
        $receivedContact->birthday_time, $items, $head, '../');

    $username = $receivedContact->username;
    if ($username !== '') {
        $items[] = \Form\label('Zvini username', htmlspecialchars($username));
    }

    $timezone = $receivedContact->timezone;
    if ($timezone !== null) {

        include_once "$fnsDir/Form/timezoneLabel.php";
        $items[] = \Form\timezoneLabel($timezone);

        $scripts .= compressed_js_script('timezoneLabel', '../../../');

    }

    $tags = $receivedContact->tags;
    if ($tags !== '') $items[] = \Form\label('Tags', htmlspecialchars($tags));

    $notes = $receivedContact->notes;
    if ($notes !== '') {
        $items[] = \Form\label('Notes', nl2br(htmlspecialchars($notes)));
    }

    include_once "$fnsDir/export_date_ago.php";
    include_once "$fnsDir/Page/infoText.php";
    $infoText = \Page\infoText(
        ($receivedContact->favorite ? 'Favorite' : 'Regular').' contact.'
        .'<br />'
        .'Contact received '.export_date_ago($receivedContact->insert_time).'.'
    );

    include_once __DIR__.'/createContent.php';
    return createContent($receivedContact, $infoText, $items, $scripts);

}
