<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/Profil")
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("", name="profil_affichage")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('profil/index.html.twig', [
            'profil' => $user,
        ]);
    }
}
