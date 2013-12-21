<?php

function create_folder_link ($id) {
    if ($id) return "./?idfolders=$id";
    return './';
}
