<?php

namespace NoteTags;

function deleteOnUser ($mysqli, $idusers) {
    mysqli_query($mysqli, "delete from notetags where idusers = $idusers");
}
