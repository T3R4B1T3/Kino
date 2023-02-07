<?php

namespace App\Controller;

use App\Entity\FilmShowTakenSeat;
use App\Repository\FilmShowRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]

    public function payment(FilmShowRepository $filmShowRepository, Request $request): Response
    {
        var_dump($request->get('seats'));

        return $this->render('payment/index.html.twig');
    }

    #[Route('/payment/success', name: 'app_payment_success')]
    public function paymentSuccess(
        FilmShowRepository $filmShowRepository,
        ManagerRegistry $doctrine,
        Request $request){
        var_dump(json_decode($request->get('filmShowId')));
        var_dump(json_decode($request->get('takenSeats')));

        $entityManager = $doctrine->getManager();
        $film = new FilmShowTakenSeat();
        $film->setFilmShow($filmShowRepository->findBy([
            'id' => $request->get('filmShowId')
        ])[0]);
        $film->setLine(2);
        $film->setSeat(7);
        $entityManager->persist($film);
        $entityManager->flush();

        return $this->render('payment/index.html.twig');
    }

    #[Route('/payment/failed', name: 'app_payment_failed')]
    public function paymentFailed(){
        var_dump("NIE POSZLO");
        return $this->render('payment/index.html.twig');
    }
}
