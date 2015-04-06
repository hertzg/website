<?php

namespace ViewPage;

function optionsPanel ($contact, $base) {

    $id = $contact->id;
    $full_name = $contact->full_name;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($id);

    include_once "$fnsDir/Page/imageLink.php";
    $safe_name = str_replace('/', '_', $full_name);
    $href = "$base../download/$id/$safe_name.vcf";
    $downloadLink = \Page\imageLink('Download', $href, 'download');

    include_once "$fnsDir/Page/imageArrowLink.php";
    $editLink = \Page\imageArrowLink('Edit',
        "$base../edit/$escapedItemQuery", 'edit-contact', ['id' => 'edit']);

    $params = ['full_name' => $full_name];
    $alias = $contact->alias;
    if ($alias !== '') $params['alias'] = $alias;
    $address = $contact->address;
    if ($address !== '') $params['address'] = $address;
    $email = $contact->email;
    if ($email !== '') $params['email'] = $email;
    $phone1 = $contact->phone1;
    if ($phone1 !== '') $params['phone1'] = $phone1;
    $phone2 = $contact->phone2;
    if ($phone2 !== '') $params['phone2'] = $phone2;
    $birthday_time = $contact->birthday_time;
    if ($birthday_time !== null) $params['birthday_time'] = $birthday_time;
    $username = $contact->username;
    if ($username !== '') $params['username'] = $username;
    $timezone = $contact->timezone;
    if ($timezone !== null) $params['timezone'] = $timezone;
    $tags = $contact->tags;
    if ($tags !== '') $params['tags'] = $tags;
    $notes = $contact->notes;
    if ($notes !== '') $params['notes'] = $notes;
    if ($contact->favorite) $params['favorite'] = '1';
    $href = "$base../new/?".htmlspecialchars(http_build_query($params));
    $duplicateLink = \Page\imageArrowLink(
        'Duplicate', $href, 'duplicate-contact');

    $sendLink = \Page\imageArrowLink('Send',
        "$base../send/$escapedItemQuery", 'send', ['id' => 'send']);

    include_once __DIR__.'/../contact_sms_text.php';
    $href = 'sms:?body='.rawurlencode(contact_sms_text($contact));
    $sendViaSmsLink = \Page\imageLink('Send via SMS', $href, 'send-sms');

    $href = "$base../delete/$escapedItemQuery";
    $deleteLink =
        '<div id="deleteLink">'
            .\Page\imageLink('Delete', $href, 'trash-bin')
        .'</div>';

    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        \Page\staticTwoColumns($downloadLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($editLink, $sendLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendViaSmsLink, $deleteLink);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Contact Options', $content);
}
