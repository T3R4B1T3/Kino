<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'room_id', targetEntity: FilmShow::class, orphanRemoval: true)]
    private Collection $filmShows;

    public function __construct()
    {
        $this->filmShows = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, FilmShow>
     */
    public function getFilmShows(): Collection
    {
        return $this->filmShows;
    }

    public function addFilmShow(FilmShow $filmShow): self
    {
        if (!$this->filmShows->contains($filmShow)) {
            $this->filmShows->add($filmShow);
            $filmShow->setRoom($this);
        }

        return $this;
    }

    public function removeFilmShow(FilmShow $filmShow): self
    {
        if ($this->filmShows->removeElement($filmShow)) {
            // set the owning side to null (unless already changed)
            if ($filmShow->getRoom() === $this) {
                $filmShow->setRoom(null);
            }
        }

        return $this;
    }
}
