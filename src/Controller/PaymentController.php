<?php

namespace App\Controller;

use App\Entity\FilmShowTakenSeat;
use App\Repository\FilmShowRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Lock\Store\FlockStore;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    public array $locks;

    public function __construct() {
        $this->locks = [];
    }

    #[Route('/payment', name: 'app_payment')]
    public function payment(
        Request $request,
        Session $session
    ): Response {
        $seats = $request->get('seats');
        $filmShowId = $request->get('filmShowId');
        $session->set('seats', json_encode($seats));
        $session->set('filmShowId', $filmShowId);

        $store = new FlockStore();
        $lockFactory = new LockFactory($store);

        for($i = 0; $i < count($seats); $i++) {
            $this->locks[$i] = $lockFactory->createLock($filmShowId."-".$seats[$i]);
        }

        return $this->render('payment/index.html.twig');
    }

    #[Route('/payment/success', name: 'app_payment_success')]
    public function paymentSuccess(
        FilmShowRepository $filmShowRepository,
        ManagerRegistry $doctrine,
        Session $session
    ) {
        $seats = json_decode($session->get('seats'));
        $filmShowId = $session->get('filmShowId');


        $entityManager = $doctrine->getManager();

        for($i = 0; $i < count($seats); $i++) {
            $film = new FilmShowTakenSeat();
            $film->setFilmShow($filmShowRepository->findOneBy([
                'id' => $filmShowId
            ]));
            $film->setLine((int)explode('-' ,$seats[$i])[0]);
            $film->setSeat((int)explode('-' ,$seats[$i])[1]);
            $entityManager->persist($film);
        }

        foreach($this->locks as $lock) {
            $lock->relase();
        }

        $entityManager->flush();

        return $this->render('payment/success.html.twig');
    }

    #[Route('/payment/failed', name: 'app_payment_failed')]
    public function paymentFailed()
    {
        return $this->render('payment/failure.html.twig');
    }
}