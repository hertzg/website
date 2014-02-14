<?php

namespace NoteTags;

function deleteOnNote ($mysqli, $idnotes) {
    mysqli_query($mysqli, "delete from notetags where idnotes = $idnotes");
}
