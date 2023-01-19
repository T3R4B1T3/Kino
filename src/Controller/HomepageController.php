<?php

namespace App\Controller;

use App\Repository\FilmShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(FilmShowRepository $filmShowRepository): Response
    {
        $filmShows = $filmShowRepository->findAll();

        return $this->render('homepage/index.html.twig', [
            'filmShows' => $filmShows,
        ]);
    }
}
