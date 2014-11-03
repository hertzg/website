<?php

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_admin.php';
require_admin();

include_once "$fnsDir/request_strings.php";
list($username, $password1, $password2) = request_strings(
    'username', 'password1', 'password2');

include_once "$fnsDir/str_collapse_spaces.php";
$username = str_collapse_spaces($username);

$errors = [];

include_once 'fns/check_username.php';
check_username($username, $errors);

if ($password1 === '') $errors[] = 'Enter new password.';
else {
    include_once "$fnsDir/Password/isShort.php";
    if (Password\isShort($password1)) {
        include_once "$fnsDir/Password/minLength.php";
        $minLength = Password\minLength();
        $errors[] = 'Password too short.'
            ." At least $minLength characters required.";
    } elseif ($password1 === $username) {
        $errors[] = 'Please, choose a password'
            .' that is different from the username.';
    } elseif ($password1 !== $password2) {
        $errors[] = 'New passwords does not match.';
    }
}

if (!$errors) {

    include_once "$fnsDir/Password/hash.php";
    list($hash, $salt) = Password\hash($password1);

    $content =
        "<?php\n\n"
        ."function get_admin (&\$username, &\$hash, &\$salt) {\n"
        ."    \$username = ".var_export($username, true).";\n"
        ."    \$hash = '".bin2hex($hash)."';\n"
        ."    \$salt = '".bin2hex($salt)."';\n"
        ."}\n";

    $filename = '../fns/get_admin.php';
    $ok = @file_put_contents($filename, $content);
    if ($ok) opcache_invalidate($filename);
    else $errors[] = 'Failed to save the data.';

}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['admin/username-password/values'] = [
        'username' => $username,
        'password1' => $password1,
        'password2' => $password2,
    ];
    $_SESSION['admin/username-password/errors'] = $errors;
    redirect();
}

$_SESSION['admin/messages'] = ['Password has been changed.'];
redirect('..');