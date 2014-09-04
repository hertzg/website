<?php

function vcard_encode ($text) {
    return preg_replace_callback("/[\n,\\\\]/", function ($match) {
        $char = $match[0];
        if ($char === "\n") return '\n';
        return "\\$char";
    }, $text);
}

include_once '../../fns/require_contact.php';
include_once '../../../lib/mysqli.php';
list($contact, $id, $user) = require_contact($mysqli, '../');

header('Content-Type: text/vcard; charset=UTF-8');

$text =
    "BEGIN:VCARD\n"
    ."VERSION:4.0\n"
    .'FN:'.vcard_encode($contact->full_name)."\n";

$phone1 = str_replace(' ', '', $contact->phone1);
if ($phone1 !== '') $text .= 'TEL:'.vcard_encode($phone1)."\n";

$phone2 = str_replace(' ', '', $contact->phone2);
if ($phone2 !== '') $text .= 'TEL:'.vcard_encode($phone2)."\n";

$email = $contact->email;
if ($email !== '') $text .= 'EMAIL:'.vcard_encode($email)."\n";

$address = $contact->address;
if ($address !== '') $text .= 'ADR:'.vcard_encode($address)."\n";

$text .= "END:VCARD\n";

echo $text;
