<?php

namespace App\Controller;

use App\Form\FilmShowType;
use App\Repository\FilmShowRepository;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        FilmShowRepository $filmShowRepository,
        Request $request
    ): Response
    {
        $form = $this->createForm(FilmShowType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomId = $filmShowRepository->findOneByTitle(
                $form->getData()->getTitle()
            )->getRoom()->getId();
            $filmShowId = $filmShowRepository->findOneByTitle(
                $form->getData()->getTitle()
            )->getId();

            return $this->redirectToRoute('app_reservation', [
                'filmShowId' => $filmShowId,
                'roomId' => $roomId
            ]);
        }

        return $this->render('homepage/index.html.twig', [
            'form' => $form,
        ]);
    }
}
