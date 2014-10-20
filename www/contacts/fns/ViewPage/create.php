<?php

namespace ViewPage;

function create ($contact, $base = '') {

    $id = $contact->id_contacts;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($keyword) = request_strings('keyword');

    include_once "$fnsDir/str_collapse_spaces.php";
    $keyword = str_collapse_spaces($keyword);

    $full_name = htmlspecialchars($contact->full_name);
    if ($keyword !== '') {
        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
        $replace = '<mark>$0</mark>';
        $full_name = preg_replace($regex, $replace, $full_name);
    }

    include_once "$fnsDir/Form/label.php";
    $items = [\Form\label('Full name', $full_name)];

    $alias = $contact->alias;
    if ($alias !== '') {
        $alias = htmlspecialchars($alias);
        if ($keyword !== '') $alias = preg_replace($regex, $replace, $alias);
        $items[] = \Form\label('Alias', $alias);
    }

    $address = $contact->address;
    if ($address !== '') {
        $items[] = \Form\label('Address', htmlspecialchars($address));
    }

    $email = $contact->email;
    if ($email !== '') {
        $escapedEmail = htmlspecialchars($email);
        $href = "mailto:$escapedEmail";
        include_once "$fnsDir/Form/link.php";
        $items[] = \Form\link('Email', $escapedEmail, $href, 'mail');
    }

    include_once __DIR__.'/../render_phone_number.php';
    render_phone_number('Phone 1', $contact->phone1, $items, $keyword);
    render_phone_number('Phone 2', $contact->phone2, $items, $keyword);

    include_once __DIR__.'/../../fns/render_birthday.php';
    render_birthday($contact->birthday_time, $items, $base);

    $username = $contact->username;
    if ($username !== '') {
        $items[] = \Form\label('Zvini username', htmlspecialchars($username));
    }

    $timezone = $contact->timezone;
    if ($timezone !== null) {
        include_once "$fnsDir/Form/timezoneLabel.php";
        $items[] = \Form\timezoneLabel($timezone);
    }

    $insert_time = $contact->insert_time;
    $update_time = $contact->update_time;

    $tags = json_decode($contact->tags_json);
    if ($tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags($base, $tags);
    }

    $notes = $contact->notes;
    if ($notes !== '') {
        $items[] = \Form\label('Notes', nl2br(htmlspecialchars($notes)));
    }

    include_once "$fnsDir/date_ago.php";
    $text =
        '<div>'.($contact->favorite ? 'Favorite' : 'Regular').' contact.</div>'
        .'<div>Contact created '.date_ago($insert_time).'.</div>';
    if ($insert_time != $update_time) {
        $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
    }
    include_once "$fnsDir/Page/infoText.php";
    $infoText = \Page\infoText($text);

    include_once __DIR__.'/createContent.php';
    return createContent($contact, $infoText, $items, $base);

}
