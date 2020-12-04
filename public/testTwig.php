<?php
require_once "../vendor/autoload.php";

class Client{
    private $noù;
    public function getNom() {
        $this->nom = 'Haddock';
        return($this->nom);
    }
}
$data = new Client();

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/views/');
$envTwig = new Twig\Environment($loader);

echo $envTwig-> render(
    'monTemplate.html.twig', ['msg'=>$data]
);
