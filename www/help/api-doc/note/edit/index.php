<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/note_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
include_once '../../../../fns/Tags/maxNumber.php';
note_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to edit.',
    ],
    [
        'name' => 'text',
        'description' => 'The new text of the note.',
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
], ApiDoc\trueResult(), [
    'NOTE_NOT_FOUND' => "A note with the ID doesn't exist.",
    'ENTER_TEXT' => 'The new text is empty.',
    'TOO_MANY_TAGS' => 'More than '.Tags\maxNumber().' tags given.',
    'CANNOT_PASSWORD_PROTECT' => 'A password-authenticated'
        .' session is required to password-protect the note.',
]);
