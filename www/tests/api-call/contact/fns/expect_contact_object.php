<?php

function expect_contact_object ($engine, $variableName, $contact) {

    $properties = ['id', 'full_name', 'alias', 'address',
        'email1', 'email1_label', 'email2', 'email2_label',
        'phone1', 'phone1_label', 'phone2', 'phone2_label',
        'birthday_time', 'username', 'timezone', 'tags',
        'notes', 'favorite', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $contact);

    $engine->expectNatural("$variableName.id", $contact->id);
    $engine->expectType("$variableName.full_name",
        'string', $contact->full_name);
    $engine->expectType("$variableName.alias", 'string', $contact->alias);
    $engine->expectType("$variableName.address", 'string', $contact->address);
    $engine->expectType("$variableName.email1", 'string', $contact->email1);
    $engine->expectType("$variableName.email1_label",
        'string', $contact->email1_label);
    $engine->expectType("$variableName.email2", 'string', $contact->email2);
    $engine->expectType("$variableName.email2_label",
        'string', $contact->email2_label);
    $engine->expectType("$variableName.phone1", 'string', $contact->phone1);
    $engine->expectType("$variableName.phone1_label",
        'string', $contact->phone1_label);
    $engine->expectType("$variableName.phone2", 'string', $contact->phone2);
    $engine->expectType("$variableName.phone2_label",
        'string', $contact->phone2_label);
    $engine->expectType("$variableName.birthday_time",
        'integer', $contact->birthday_time);
    $engine->expectType("$variableName.username", 'string', $contact->username);

    $timezone = $contact->timezone;
    if ($timezone !== null) {
        $engine->expectType("$variableName.timezone",
            'integer', $contact->timezone);
    }

    $engine->expectType("$variableName.tags", 'string', $contact->tags);
    $engine->expectType("$variableName.notes", 'string', $contact->notes);
    $engine->expectType("$variableName.favorite",
        'boolean', $contact->favorite);
    $engine->expectNatural("$variableName.insert_time", $contact->insert_time);
    $engine->expectNatural("$variableName.update_time", $contact->update_time);

}
