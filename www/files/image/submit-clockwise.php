<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once 'fns/require_image_file.php';
include_once '../../lib/mysqli.php';
list($file, $id, $user) = require_image_file($mysqli);

include_once '../../fns/Files/File/path.php';
$path = Files\File\path($user->id_users, $id);

$errors = [];

$image = imagecreatefromstring(file_get_contents($path));
if ($image) {

    $rotatedImage = imagerotate($image, -90, 0);

    $content_type = $file->content_type;
    if ($content_type == 'image/jpeg') {
        imagejpeg($file->image, $path);
    } elseif ($content_type == 'image/png') {
        imagepng($rotatedImage, $path);
    } else {
        $errors[] = 'Cannot save an image of this type.';
    }

} else {
    $errors[] = 'Failed to open the image.';
}

if ($errors) {
    $_SESSION['files/view-file/errors'] = $errors;
    unset($_SESSION['files/view-file/messages']);
} else {
    $_SESSION['files/view-file/messages'] = ['The image has been rotated.'];
    unset($_SESSION['files/view-file/errors']);
}

include_once '../../fns/redirect.php';
redirect("../view-file/?id=$id");
