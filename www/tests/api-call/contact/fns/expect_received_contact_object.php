<?php

function expect_received_contact_object ($engine,
    $variableName, $receivedContact) {

    $properties = ['id', 'sender_username', 'full_name',
        'alias', 'address', 'email1', 'email1_label', 'email2',
        'email2_label', 'phone1', 'phone1_label', 'phone2',
        'phone2_label', 'birthday_time', 'username', 'timezone',
        'tags', 'notes', 'favorite', 'tags', 'insert_time'];
    $engine->expectObject($variableName, $properties, $receivedContact);

    $engine->expectNatural("$variableName.id", $receivedContact->id);
    $engine->expectType("$variableName.sender_username", 'string',
        $receivedContact->sender_username);
    $engine->expectType("$variableName.full_name",
        'string', $receivedContact->full_name);
    $engine->expectType("$variableName.alias",
        'string', $receivedContact->alias);
    $engine->expectType("$variableName.address",
        'string', $receivedContact->address);
    $engine->expectType("$variableName.email1",
        'string', $receivedContact->email1);
    $engine->expectType("$variableName.email1_label",
        'string', $receivedContact->email1_label);
    $engine->expectType("$variableName.email2",
        'string', $receivedContact->email2);
    $engine->expectType("$variableName.email2_label",
        'string', $receivedContact->email2_label);
    $engine->expectType("$variableName.phone1",
        'string', $receivedContact->phone1);
    $engine->expectType("$variableName.phone1_label",
        'string', $receivedContact->phone1_label);
    $engine->expectType("$variableName.phone2",
        'string', $receivedContact->phone2);
    $engine->expectType("$variableName.phone2_label",
        'string', $receivedContact->phone2_label);
    $engine->expectType("$variableName.birthday_time",
        'integer', $receivedContact->birthday_time);
    $engine->expectType("$variableName.username",
        'string', $receivedContact->username);

    $timezone = $receivedContact->timezone;
    if ($timezone !== null) {
        $engine->expectType("$variableName.timezone",
            'integer', $contact->timezone);
    }

    $engine->expectType("$variableName.tags",
        'string', $receivedContact->tags);
    $engine->expectType("$variableName.notes",
        'string', $receivedContact->notes);
    $engine->expectType("$variableName.favorite",
        'boolean', $receivedContact->favorite);
    $engine->expectType("$variableName.tags",
        'string', $receivedContact->tags);
    $engine->expectNatural("$variableName.insert_time",
        $receivedContact->insert_time);

}
