<?php


namespace App\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints as Assert;

class Inscription
{
    /**
     * @Assert\Length( min = 2,max = 50  )
     * @var string
     */
    public $login;

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }


}