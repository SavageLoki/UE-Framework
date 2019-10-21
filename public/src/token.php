<?php
require_once __DIR__."/../../vendor/autoload.php";

use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;

$tokenGener = new UriSafeTokenGenerator();
echo $tokenGener->generateToken();

