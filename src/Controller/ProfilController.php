<?php

namespace App\Controller;

use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/modifier" , name="profil_modifier")
    *
     */
    public function modifier(Request $request, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();
        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Profil modifié avec succes !');
            return $this->redirectToRoute("profil_affichage");
        }

        $entityManager->refresh($user);
        return $this->renderForm('profil/modifier.html.twig', [
            'formModifier' => $form,
        ]);
    }
}
