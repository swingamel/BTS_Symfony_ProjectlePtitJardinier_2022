<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class TypeClientSearch
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeClient")
     */
    private $typeClient;

    public function getTypeClient(): ?TypeClient
    {
        return $this->typeClient;
    }

    public function setTypeClient(?TypeClient $typeClient): self
    {
        $this->typeClient = $typeClient;

        return $this;
    }
}