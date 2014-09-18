<?php

namespace ViewPage;

function renderContact ($id, $contact, &$items, &$infoText) {

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

    $email = $contact->email;
    if ($email !== '') {
        $labelItems[] = \Form\label('Email', htmlspecialchars($email));
    }

    $phone1 = $contact->phone1;
    if ($phone1 !== '') {
        $labelItems[] = \Form\label('Phone 1', htmlspecialchars($phone1));
    }

    $phone2 = $contact->phone2;
    if ($phone2 !== '') {
        $labelItems[] = \Form\label('Phone 2', htmlspecialchars($phone2));
    }

    $birthday_time = $contact->birthday_time;
    if ($birthday_time !== null) {
        $labelItems[] = \Form\label('Birthday', date('F d, Y', $birthday_time));
    }

    $username = $contact->username;
    if ($username !== '') {
        $labelItems[] = \Form\label('Username', htmlspecialchars($username));
    }

    $timezone = $contact->timezone;
    if ($timezone !== null) {
        include_once "$fnsDir/Form/timezoneLabel.php";
        $labelItems[] = \Form\timezoneLabel('../../', $timezone);
    }

    $tags = $contact->tags;
    if ($tags !== '') {
        $labelItems[] = \Form\label('Tags', htmlspecialchars($tags));
    }

    $priority = $contact->favorite ? 'Favorite' : 'Regular';
    $infoText = "$priority contact.</br>$infoText";

    if ($contact->photo_id) $photoSrc = "../download-photo/?id=$id";
    else $photoSrc = '../../images/empty-photo.svg';

    $content = join('<div class="hr"></div>', $labelItems);

    include_once "$fnsDir/create_contact_panel.php";
    $items[] = create_contact_panel($photoSrc, $content);

}
