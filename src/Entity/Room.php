<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $row_count = null;

    #[ORM\Column]
    private ?int $row_seat_count = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRowCount(): ?int
    {
        return $this->row_count;
    }

    public function setRowCount(int $row_count): self
    {
        $this->row_count = $row_count;

        return $this;
    }

    public function getRowSeatCount(): ?int
    {
        return $this->row_seat_count;
    }

    public function setRowSeatCount(int $row_seat_count): self
    {
        $this->row_seat_count = $row_seat_count;

        return $this;
    }
}
