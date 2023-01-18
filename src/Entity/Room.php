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

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Seat::class)]
    private Collection $Seat;

    public function __construct()
    {
        $this->Seat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Seat>
     */
    public function getSeat(): Collection
    {
        return $this->Seat;
    }

    public function addSeat(Seat $seat): self
    {
        if (!$this->Seat->contains($seat)) {
            $this->Seat->add($seat);
            $seat->setRoom($this);
        }

        return $this;
    }

    public function removeSeat(Seat $seat): self
    {
        if ($this->Seat->removeElement($seat)) {
            // set the owning side to null (unless already changed)
            if ($seat->getRoom() === $this) {
                $seat->setRoom(null);
            }
        }

        return $this;
    }
}
