<?php

namespace App\Controller;

use App\Entity\FilmShowTakenSeat;
use App\Repository\FilmShowRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    public function payment(
        FilmShowRepository $filmShowRepository,
        Request $request,
        Session $session
    ): Response {
        $seats = $request->get('seats');
        $filmShowId = $request->get('filmShowId');
        $session->set('seats', json_encode($seats));
        $session->set('filmShowId', $filmShowId);

        return $this->render('payment/index.html.twig');
    }

    #[Route('/payment/success', name: 'app_payment_success')]
    public function paymentSuccess(
        FilmShowRepository $filmShowRepository,
        ManagerRegistry $doctrine,
        Request $request,
        Session $session
    ) {
        $seats = $session->get('seats');
        $filmShowId = $request->get('filmShowId');

        $entityManager = $doctrine->getManager();
        $film = new FilmShowTakenSeat();
        $film->setFilmShow($filmShowRepository->findBy([
            'id' => $filmShowId
        ])[0]);
        $film->setLine(2);
        $film->setSeat(7);
        $entityManager->persist($film);
        $entityManager->flush();

        return $this->render('payment/index.html.twig');
    }

    #[Route('/payment/failed', name: 'app_payment_failed')]
    public function paymentFailed()
    {
        var_dump("NIE POSZLO");
        return $this->render('payment/index.html.twig');
    }
}
