<?php

namespace App\Entity;

use App\Repository\FilmShowTakenSeatRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

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

    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private Uuid $reservation_number;

    #[ORM\ManyToOne(inversedBy: 'filmShowTakenSeats')]
    #[ORM\JoinColumn(nullable: true)]
    private ?FilmShow $film_show = null;

    public function __construct()
    {
        $this->reservation_number = Uuid::v7();
    }

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

    public function getReservationNumber(): ?Uuid
    {
        return $this->reservation_number;
    }

    public function getFilmShow(): ?FilmShow
    {
        return $this->film_show;
    }

    public function setFilmShow(?FilmShow $film_show): self
    {
        $this->film_show = $film_show;

        return $this;
    }
}
