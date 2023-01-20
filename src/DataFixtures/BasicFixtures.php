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
        $filmShow->setRoom($room);
        $filmShow->setTitle("Predator");
        $manager->persist($filmShow);

        $filmShowTakenSeat = new FilmShowTakenSeat();
        $filmShowTakenSeat->setFilmShow($filmShow);
        $filmShowTakenSeat->setSeat(2);
        $filmShowTakenSeat->setLine(1);
        $filmShowTakenSeat->setReservationNumber(1);
        $manager->persist($filmShowTakenSeat);

        $filmShowTakenSeat = new FilmShowTakenSeat();
        $filmShowTakenSeat->setFilmShow($filmShow);
        $filmShowTakenSeat->setSeat(3);
        $filmShowTakenSeat->setLine(7);
        $filmShowTakenSeat->setReservationNumber(1);
        $manager->persist($filmShowTakenSeat);

        $filmShow = new FilmShow();
        $filmShow->setRoom($room);
        $filmShow->setTitle("Titanic");
        $manager->persist($filmShow);

        $room = new Room();
        $room->setRowCount(5);
        $room->setRowSeatCount(15);
        $manager->persist($room);

        $filmShow = new FilmShow();
        $filmShow->setRoom($room);
        $filmShow->setTitle("Indiana Jones");
        $manager->persist($filmShow);

        $filmShowTakenSeat = new FilmShowTakenSeat();
        $filmShowTakenSeat->setFilmShow($filmShow);
        $filmShowTakenSeat->setSeat(6);
        $filmShowTakenSeat->setLine(3);
        $filmShowTakenSeat->setReservationNumber(1);
        $manager->persist($filmShowTakenSeat);

        $manager->flush();
    }
}
