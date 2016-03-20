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
    $email1 = $contact->email1;
    if ($email1 !== '') $params['email1'] = $email1;
    $email1_label = $contact->email1_label;
    if ($email1_label !== '') $params['email1_label'] = $email1_label;
    $email2 = $contact->email2;
    if ($email2 !== '') $params['email2'] = $email2;
    $email2_label = $contact->email2_label;
    if ($email2_label !== '') $params['email2_label'] = $email2_label;
    $phone1 = $contact->phone1;
    if ($phone1 !== '') $params['phone1'] = $phone1;
    $phone1_label = $contact->phone1;
    if ($phone1_label !== '') $params['phone1_label'] = $phone1_label;
    $phone2 = $contact->phone2;
    if ($phone2 !== '') $params['phone2'] = $phone2;
    $phone2_label = $contact->phone2_label;
    if ($phone2_label !== '') $params['phone2_label'] = $phone2_label;
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

    $historyLink = \Page\imageArrowLink('History',
        "../history/?id=$id", 'restore-defaults', ['id' => 'history']);

    $deleteLink = \Page\imageLink('Delete',
        "$base../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once __DIR__.'/../send_via_sms_link.php';
    include_once "$fnsDir/Page/staticTwoColumns.php";
    include_once "$fnsDir/Page/twoColumns.php";
    $content =
        $downloadLink
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($editLink, $duplicateLink)
        .'<div class="hr"></div>'
        .\Page\twoColumns($sendLink, send_via_sms_link($contact))
        .'<div class="hr"></div>'
        .\Page\staticTwoColumns($historyLink, $deleteLink);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Contact Options', $content);
}
