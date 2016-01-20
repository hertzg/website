<?php

namespace ViewPage;

function renderContact ($id, $contact, &$items, &$infoText, &$scripts) {

    $base = '../../';
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Form/label.php";
    $labelItems = [
        \Form\label('Full name', htmlspecialchars($contact->full_name)),
    ];

    $alias = $contact->alias;
    if ($alias !== '') {
        $labelItems[] = \Form\label('Alias', htmlspecialchars($alias));
    }

    $address = $contact->address;
    if ($address !== '') {
        $labelItems[] = \Form\label('Address', htmlspecialchars($address));
    }

    include_once __DIR__.'/renderContactEmails.php';
    renderContactEmails($contact, $labelItems);

    include_once __DIR__.'/renderContactPhones.php';
    renderContactPhones($contact, $labelItems);

    $birthday_time = $contact->birthday_time;
    if ($birthday_time !== null) {
        $labelItems[] = \Form\label('Birthday', date('F j, Y', $birthday_time));
    }

    $username = $contact->username;
    if ($username !== '') {
        $labelItems[] = \Form\label('Username', htmlspecialchars($username));
    }

    $timezone = $contact->timezone;
    if ($timezone !== null) {

        include_once "$fnsDir/Form/timezoneLabel.php";
        $labelItems[] = \Form\timezoneLabel($timezone);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts .= compressed_js_script('timezoneLabel', $base);

    }

    $tags = $contact->tags;
    if ($tags !== '') {
        $labelItems[] = \Form\label('Tags', htmlspecialchars($tags));
    }

    $notes = $contact->notes;
    if ($notes !== '') {
        $labelItems[] = \Form\label('Notes', nl2br(htmlspecialchars($notes)));
    }

    $priority = $contact->favorite ? 'Favorite' : 'Regular';
    $infoText = "$priority contact.</br>$infoText";

    if ($contact->photo_id) $photoSrc = "../download-photo/?id=$id";
    else $photoSrc = '../../images/empty-photo.svg';

    $content = join('<div class="hr"></div>', $labelItems);

    include_once "$fnsDir/create_contact_panel.php";
    $items[] = create_contact_panel($photoSrc, $content, $base);

}
