<?php

function rotate_image ($mysqli, $file, $degrees) {

    $errors = [];
    $id = $file->id_files;
    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Files/File/path.php";
    $path = Files\File\path($file->id_users, $id);

    $image = imagecreatefromstring(file_get_contents($path));
    if ($image) {

        imagesavealpha($image, true);
        $rotatedImage = imagerotate($image, $degrees, 0);

        $content_type = $file->content_type;
        if ($content_type == 'image/jpeg') {
            imagejpeg($rotatedImage, $path);
        } elseif ($content_type == 'image/gif') {
            imagegif($rotatedImage, $path);
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

        include_once "$fnsDir/Files/editContent.php";
        Files\editContent($mysqli, $id, filesize($path));

        $_SESSION['files/view-file/messages'] = ['The image has been rotated.'];
        unset($_SESSION['files/view-file/errors']);

    }

    include_once "$fnsDir/redirect.php";
    redirect("../view-file/?id=$id");

}
