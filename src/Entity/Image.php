<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private string $image;

    #[ORM\Column(length: 200)]
    private string $name;

    #[ORM\Column]
    private int $number;


    public function getImage(): string
    {
        return $this->image;
    }
    public function setImage(string $image): void
    {
        $this->image = $image;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getNumber(): int
    {
        return $this->number;
    }
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }
}

