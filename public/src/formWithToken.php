<?php
require_once __DIR__."/../../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

const TOKENID = 'monFormulaire';

$session = new Session();
$csrfGenerator = new UriSafeTokenGenerator();
$csrfStorage = new SessionTokenStorage($session);

$csrfStorage->setToken(TOKENID, $csrfGenerator->generateToken());
$token = $csrfStorage->getToken(TOKENID);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>
<body>
<form name="form" action="/src/formValideToken.php" method="post">
    <input type="text" name="form[login]"/>
    <input type="submit" value="ok" name="form[ok]"/>
    <input type="hidden" value="<?= $token?>" name="form[_token]"/>
</form>
</form>
</body>
</html>
