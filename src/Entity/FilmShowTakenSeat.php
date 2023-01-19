<?php

namespace App\Entity;

use App\Repository\FilmShowTakenSeatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmShowTakenSeatRepository::class)]
class FilmShowTakenSeat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $line = null;

    #[ORM\Column]
    private ?int $seat = null;

    #[ORM\Column]
    private ?int $reservation_number = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLine(): ?int
    {
        return $this->line;
    }

    public function setLine(int $line): self
    {
        $this->line = $line;

        return $this;
    }

    public function getSeat(): ?int
    {
        return $this->seat;
    }

    public function setSeat(int $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    public function getReservationNumber(): ?int
    {
        return $this->reservation_number;
    }

    public function setReservationNumber(int $reservation_number): self
    {
        $this->reservation_number = $reservation_number;

        return $this;
    }
}
