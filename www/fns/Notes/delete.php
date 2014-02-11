<?php

namespace Notes;

function delete ($mysqli, $id) {
    mysqli_query($mysqli, "delete from notes where idnotes = $id");
}
