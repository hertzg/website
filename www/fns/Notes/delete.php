<?php

namespace Notes;

function delete ($mysqli, $id) {
    $mysqli->query("delete from notes where idnotes = $id");
}
