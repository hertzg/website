<?php

namespace ViewPage;

function create ($user, $contact, &$head, &$scripts, $base = '') {

    $id = $contact->id;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', "$base../../");

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

    include_once __DIR__.'/../render_emails.php';
    render_emails($contact, $items, $keyword);

    include_once __DIR__.'/../render_phone_numbers.php';
    render_phone_numbers($contact, $items, $keyword);

    include_once __DIR__.'/../../fns/render_birthday.php';
    render_birthday($user, $contact->birthday_time, $items, $head, $base);

    $username = $contact->username;
    if ($username !== '') {
        $items[] = \Form\label('Zvini username', htmlspecialchars($username));
    }

    $timezone = $contact->timezone;
    if ($timezone !== null) {

        include_once "$fnsDir/Form/timezoneLabel.php";
        $items[] = \Form\timezoneLabel($timezone);

        $scripts .= compressed_js_script('timezoneLabel', "$base../../");

    }

    if ($contact->num_tags) {
        include_once "$fnsDir/Form/tags.php";
        $items[] = \Form\tags($base, json_decode($contact->tags_json));
    }

    $notes = $contact->notes;
    if ($notes !== '') {
        $items[] = \Form\label('Notes', nl2br(htmlspecialchars($notes)));
    }

    include_once "$fnsDir/format_author.php";
    $api_key_name = $contact->insert_api_key_name;
    $author = format_author($contact->insert_time, $api_key_name);

    $infoText =
        ($contact->favorite ? 'Favorite' : 'Regular').' contact.<br />'
        ."Contact created $author.";
    if ($contact->revision) {
        $api_key_name = $contact->update_api_key_name;
        $author = format_author($contact->update_time, $api_key_name);
        $infoText .= "<br />Last modified $author.";
    }

    include_once __DIR__.'/unsetSessionVars.php';
    unsetSessionVars();

    include_once __DIR__.'/createContent.php';
    return createContent($contact, $infoText, $items, $base, $scripts);

}
