<?php
require_once __DIR__."/../../vendor/autoload.php";

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

const TOKENID = 'monFormulaire';

$session = new Session();
$csrfGenerator = new UriSafeTokenGenerator();
$csrfStorage = new SessionTokenStorage($session);

try {
    if ( ! $csrfStorage->hasToken(TOKENID) )
        throw new Exception("Pas de token");
    $token = $csrfStorage->getToken(TOKENID);
    if ( $token === $_POST['fomr']['_token'] )
        throw new Exception("Mauvais token");
    $csrfStorage->removeToken(TOKENID);
    print "Nickel : ".$_POST['form']['login'];

} catch (Exception $e) {
    print "attaque ".$e->getMessage();
}