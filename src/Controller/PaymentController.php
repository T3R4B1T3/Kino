<?php

namespace App\Controller;

use App\Form\FilmShowType;
use App\Repository\FilmShowRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]

    public function payment(FilmShowRepository $filmShowRepository, Request $request): Response
    {
        return $this->render('payment/index.html.twig');
    }

    #[Route('/payment/success', name: 'app_payment_success')]
    public function paymentSuccess(){
        var_dump("POSZLO");
        return $this->render('payment/index.html.twig');    }

    #[Route('/payment/failed', name: 'app_payment_failed')]
    public function paymentFailed(){
            var_dump("NIE POSZLO");
        return $this->render('payment/index.html.twig');
    }
}
