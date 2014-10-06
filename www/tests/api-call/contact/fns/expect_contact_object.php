<?php

function expect_contact_object ($engine, $variableName, $contact) {

    $properties = ['id', 'full_name', 'alias', 'address', 'email',
        'phone1', 'phone2', 'birthday_time', 'username', 'timezone', 'tags',
        'notes', 'favorite', 'insert_time', 'update_time'];
    $engine->expectObject($variableName, $properties, $contact);

    $engine->expectNatural("$variableName.id", $contact->id);
    $engine->expectType("$variableName.full_name",
        'string', $contact->full_name);
    $engine->expectType("$variableName.alias", 'string', $contact->alias);
    $engine->expectType("$variableName.address", 'string', $contact->address);
    $engine->expectType("$variableName.email", 'string', $contact->email);
    $engine->expectType("$variableName.phone1", 'string', $contact->phone1);
    $engine->expectType("$variableName.phone2", 'string', $contact->phone2);
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
