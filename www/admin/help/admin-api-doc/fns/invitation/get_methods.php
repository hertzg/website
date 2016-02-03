<?php

namespace invitation;

function get_methods () {
    return [
        'add' => 'Creates a new invitation.',
        'delete' => 'Deletes an existing invitation.',
        'deleteAll' => 'Deletes all invitations.',
        'edit' => 'Edits an existing invitation.',
        'get' => 'Returns a single existing invitation.',
        'list' => 'Returns a list of all invitations.',
    ];
}
