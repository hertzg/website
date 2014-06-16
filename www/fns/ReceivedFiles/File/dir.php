<?php

namespace ReceivedFiles\File;

function dir ($receiver_id_users) {
    return __DIR__."/../../../users/$receiver_id_users/received-files";
}
