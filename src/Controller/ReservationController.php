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
        $filmShowTakenSeats = $filmShowTakenSeatRepository->findByFilmShowId(
            $request->query->get('filmShowId')
        );

        $roomEntity = $roomRepository->findBy([
            'id' => $request->query->get('roomId')
        ])[0];

        $room = (object)[
            'row_count' => $roomEntity->getRowCount(),
            'row_seat_count' => $roomEntity->getRowSeatCount()
        ];

        return $this->render('reservation/index.html.twig', [
            'filmShowTakenSeats' => $filmShowTakenSeats,
            'room' => $room
        ]);
    }
}
