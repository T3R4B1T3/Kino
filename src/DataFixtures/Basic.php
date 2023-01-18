<?php

namespace App\DataFixtures;

use App\Entity\Room;
use App\Entity\Seat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Basic extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        for( $i = 1; $i <= 3; $i++){
            for($j = 1; $j <=10; $j++){
                $seat = new Seat();
                $seat->setNumberOfSeat($j);
                $seat->setNumberOfRow($i);
                $seat->setState('avaliable');
                $seat->setNumberOfRoom(1);
                $manager->persist($seat);
            }
        }
        $manager->flush();
    }
}
