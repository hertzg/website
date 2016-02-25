<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/note_method_page.php';
include_once '../../../../fns/Tags/maxNumber.php';
note_method_page('add', [
    [
        'name' => 'text',
        'description' => 'The text of the note.',
    ],
    [
        'name' => 'encrypt_in_listings',
        'description' => 'Whether the note should be encrypted in listings.',
    ],
    [
        'name' => 'password_protect',
        'description' => 'Whether the note should be'
            .' password-protected. This option is available'
            .' with a password-authenticated session only.',
    ],
    [
        'name' => 'tags',
        'description' => 'A space-separated list of tags.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created note.',
], [
    'ENTER_TEXT' => 'The text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
    'CANNOT_PASSWORD_PROTECT' => 'A password-authenticated'
        .' session is required to password-protect the note.',
]);
