<?php

namespace contact\photo;

function get_methods () {
    return [
        'delete' => 'Deletes a photo of a contact.',
        'download' => 'Returns the content of a photo of a contact.',
        'set' => 'Sets a new photo of a contact.',
    ];
}
