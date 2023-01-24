<?php

namespace App\Controller;

use App\Repository\FilmShowTakenSeatRepository;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function reservation(
        FilmShowTakenSeatRepository $filmShowTakenSeatRepository,
        RoomRepository              $roomRepository,
        Request                     $request
    ): Response
    {
        $filmShowTakenSeats = $filmShowTakenSeatRepository->findBy([
            'film_show' => $request->query->get('filmShowId')
        ]);

        $seats = [];

        $roomEntity = $roomRepository->findBy([
            'id' => $request->query->get('roomId')
        ])[0];

        $room = (object)[
            'row_count' => $roomEntity->getRowCount(),
            'row_seat_count' => $roomEntity->getRowSeatCount()
        ];

        for ($i = 0; $i < $roomEntity->getRowCount(); $i++) {
            for ($j = 0; $j < $roomEntity->getRowSeatCount(); $j++) {
                for ($k = 0; $k < count($filmShowTakenSeats); $k++) {
                    if ($filmShowTakenSeats[$k]->getLine() == $i
                        && $filmShowTakenSeats[$k]->getSeat() == $j) {
                        $seats[$i][$j] = 1;
                        $k = count($filmShowTakenSeats) + 1;
                    } else {
                        $seats[$i][$j] = 0;
                    }
                }
            }
        }

        return $this->render('reservation/index.html.twig', [
            'seats' => $seats,
            'room' => $room
        ]);
    }
}
