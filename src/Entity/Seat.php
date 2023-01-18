<?php

namespace App\Entity;

use App\Repository\SeatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeatRepository::class)]
class Seat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numberOfRow = null;

    #[ORM\Column]
    private ?int $numberOfSeat = null;

    #[ORM\Column(length: 255)]
    private ?string $State = null;

    #[ORM\ManyToOne(inversedBy: 'Seat')]
    private ?Room $room = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfRow(): ?int
    {
        return $this->numberOfRow;
    }

    public function setNumberOfRow(int $numberOfRow): self
    {
        $this->numberOfRow = $numberOfRow;

        return $this;
    }

    public function getNumberOfSeat(): ?int
    {
        return $this->numberOfSeat;
    }

    public function setNumberOfSeat(int $numberOfSeat): self
    {
        $this->numberOfSeat = $numberOfSeat;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->State;
    }

    public function setState(string $State): self
    {
        $this->State = $State;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }
}
