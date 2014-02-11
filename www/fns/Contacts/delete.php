<?php

namespace Contacts;

function delete ($mysqli, $id) {
    mysqli_query($mysqli, "delete from contacts where idcontacts = $id");
}
