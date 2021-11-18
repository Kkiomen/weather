<?php

namespace App\Classes;

use App\Repository\CityRepository;
use Doctrine\ORM\Mapping as ORM;


class City
{

    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
