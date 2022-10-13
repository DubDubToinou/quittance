<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user/bien")
 */
class BienController extends AbstractController
{
    /**
     * @Route("/index", name="bien_index")
     */
    public function index(): Response
    {
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
        ]);
    }

    /**
     * @Route("/ajout", name="bien_ajout")
     */
    public function ajout(Request $request, EntityManagerInterface $entityManager): Response
    {

        $user = $this->getUser();

        $bien = new Bien();
        $bien->setUser($user);
        $bien->setDateCreated(new \DateTime());

        $bienForm = $this->createForm(BienFormType::class, $bien);
        $bienForm->handleRequest($request);

        if ($bienForm->isSubmitted() && $bienForm->isValid()) {
            $entityManager->persist($bien);
            $entityManager->flush();
            $this->addFlash('success', 'Bien Ajouté');
            return $this->redirectToRoute('bien_index');
        }

        return $this->renderForm('bien/ajouterBien.html.twig', [
            'bienForm' => $bienForm
        ]);


    }
}
