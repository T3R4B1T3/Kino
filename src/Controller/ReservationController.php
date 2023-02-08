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
    #[Route('/reservation', name: 'app_reservation', methods: ['GET', 'POST'])]
    public function reservation(
        FilmShowTakenSeatRepository $filmShowTakenSeatRepository,
        RoomRepository              $roomRepository,
        Request                     $request
    ): Response
    {
        $seats = [];
        if ($request->query->get('filmShowId') == null
            || $request->query->get('roomId') == null) {
            $filmShowId = $request->get('filmShowId');
            $roomId = $request->get('roomId');
        } else {
            $filmShowId = $request->query->get('filmShowId');
            $roomId = $request->query->get('roomId');
        }

        $filmShowTakenSeats = $filmShowTakenSeatRepository->findBy([
            'film_show' => $filmShowId
        ]);

        $roomEntity = $roomRepository->findBy([
            'id' => $roomId
        ])[0];

        $room = (object)[
            'row_count' => $roomEntity->getRowCount(),
            'row_seat_count' => $roomEntity->getRowSeatCount()
        ];

        for ($i = 0; $i < $roomEntity->getRowCount(); $i++) {
            for ($j = 0; $j < $roomEntity->getRowSeatCount(); $j++) {

                if ($filmShowTakenSeats !== []) {
                    for ($k = 0; $k < count($filmShowTakenSeats); $k++) {
                        if ($filmShowTakenSeats[$k]->getLine() == $i
                            && $filmShowTakenSeats[$k]->getSeat() == $j) {
                            $seats[$i][$j] = 1;
                            $k = count($filmShowTakenSeats) + 1;
                        } else {
                            $seats[$i][$j] = 0;
                        }
                    }
                } else {
                    $seats[$i][$j] = 0;
                }
            }
        }

        return $this->render('reservation/index.html.twig', [
            'seats' => $seats,
            'room' => $room,
            'filmShowId' => $filmShowId,
            'roomId' => $roomId
        ]);
    }
}