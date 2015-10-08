<?php

function contact_vcf ($contact) {

    $vcard_text = function ($text) {
        return preg_replace_callback("/[\n,\\\\]/", function ($match) {
            $char = $match[0];
            if ($char === "\n") return '\n';
            return "\\$char";
        }, $text);
    };

    $text =
        "BEGIN:VCARD\n"
        ."VERSION:4.0\n"
        .'FN:'.$vcard_text($contact->full_name)."\n";

    $alias = $contact->alias;
    if ($alias !== '') $text .= 'NICKNAME:'.$vcard_text($alias)."\n";

    $address = $contact->address;
    if ($address !== '') $text .= 'ADR;VALUE=text:'.$vcard_text($address)."\n";

    $email1 = $contact->email1;
    if ($email1 !== '') $text .= 'EMAIL:'.$vcard_text($email1)."\n";

    $email2 = $contact->email2;
    if ($email2 !== '') $text .= 'EMAIL:'.$vcard_text($email2)."\n";

    $phone1 = $contact->phone1;
    if ($phone1 !== '') $text .= 'TEL;VALUE=text:'.$vcard_text($phone1)."\n";

    $phone2 = $contact->phone2;
    if ($phone2 !== '') $text .= 'TEL;VALUE=text:'.$vcard_text($phone2)."\n";

    $birthday_time = $contact->birthday_time;
    if ($birthday_time !== null) {
        $text .= 'BDAY:'.date('Ymd', $birthday_time)."\n";
    }

    $timezone = $contact->timezone;
    if ($timezone !== null) {
        $sign = $timezone < 0 ? '-' : '+';
        $padded = str_pad(abs($timezone), 4, '0', STR_PAD_LEFT);
        $text .= "TZ;VALUE=utc-offset:$sign$padded\n";
    }

    $notes = $contact->notes;
    if ($notes !== '') $text .= 'NOTE:'.$vcard_text($notes)."\n";

    $text .= "END:VCARD\n";

    return $text;

}
