<?php

namespace App\DataFixtures;

use App\Entity\FilmShow;
use App\Entity\FilmShowTakenSeat;
use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BasicFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $room = new Room();
        $room->setRowCount(3);
        $room->setRowSeatCount(10);
        $manager->persist($room);

        $filmShow = new FilmShow();
        $filmShow->setRoomId($room->getId());
        $manager->persist($filmShow);

        $filmShowTakenSeat = new FilmShowTakenSeat();
        $filmShowTakenSeat->setFilmShowId($filmShow->getId());
        $filmShowTakenSeat->setSeat(6);
        $filmShowTakenSeat->setLine(3);
        $filmShowTakenSeat->setReservationNumber(1);
        $manager->persist($filmShowTakenSeat);

        $manager->flush();
    }
}
