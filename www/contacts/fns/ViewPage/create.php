<?php

namespace ViewPage;

function create ($contact, $base = '') {

    $id = $contact->id;
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

    if ($contact->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags($base, json_decode($contact->tags_json));
    }

    $notes = $contact->notes;
    if ($notes !== '') {
        $items[] = \Form\label('Notes', nl2br(htmlspecialchars($notes)));
    }

    $insert_time = $contact->insert_time;
    $update_time = $contact->update_time;

    include_once "$fnsDir/format_author.php";
    $author = format_author($insert_time, $contact->insert_api_key_name);

    $infoText =
        ($contact->favorite ? 'Favorite' : 'Regular').' contact.<br />'
        ."Contact created $author.";
    if ($insert_time != $update_time) {
        $author = format_author($update_time, $contact->update_api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/createContent.php';
    return createContent($contact, $infoText, $items, $base);

}
