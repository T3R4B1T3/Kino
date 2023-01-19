<?php

namespace App\Entity;

use App\Repository\FilmShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmShowRepository::class)]
class FilmShow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'filmShows')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Room $room = null;

    #[ORM\OneToMany(mappedBy: 'film_show_id', targetEntity: FilmShowTakenSeat::class, orphanRemoval: true)]
    private Collection $filmShowTakenSeats;

    public function __construct()
    {
        $this->filmShowTakenSeats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomId(): ?Room
    {
        return $this->room_id;
    }

    public function setRoomId(?Room $room_id): self
    {
        $this->room_id = $room_id;

        return $this;
    }

    /**
     * @return Collection<int, FilmShowTakenSeat>
     */
    public function getFilmShowTakenSeats(): Collection
    {
        return $this->filmShowTakenSeats;
    }

    public function addFilmShowTakenSeat(FilmShowTakenSeat $filmShowTakenSeat): self
    {
        if (!$this->filmShowTakenSeats->contains($filmShowTakenSeat)) {
            $this->filmShowTakenSeats->add($filmShowTakenSeat);
            $filmShowTakenSeat->setFilmShowId($this);
        }

        return $this;
    }

    public function removeFilmShowTakenSeat(FilmShowTakenSeat $filmShowTakenSeat): self
    {
        if ($this->filmShowTakenSeats->removeElement($filmShowTakenSeat)) {
            // set the owning side to null (unless already changed)
            if ($filmShowTakenSeat->getFilmShowId() === $this) {
                $filmShowTakenSeat->setFilmShowId(null);
            }
        }

        return $this;
    }
}
