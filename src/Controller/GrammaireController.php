<?php

namespace App\Controller;

use App\Entity\Grammaire;
use App\Form\GrammaireType;
use App\Repository\GrammaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GrammaireController extends AbstractController
{
    /**
     * @Route("/grammaire", name="grammaire_index", methods={"GET"})
     */
    public function index(GrammaireRepository $grammaireRepository): Response
    {
        return $this->render('grammaire/index.html.twig', [
            'grammaires' => $grammaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/grammaire/new", name="grammaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $grammaire = new Grammaire();
        $form = $this->createForm(GrammaireType::class, $grammaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($grammaire);
            $entityManager->flush();

            return $this->redirectToRoute('grammaire_index');
        }

        return $this->render('grammaire/new.html.twig', [
            'grammaire' => $grammaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/grammaire/{id}", name="grammaire_show", methods={"GET"})
     */
    public function show(Grammaire $grammaire): Response
    {
        return $this->render('grammaire/show.html.twig', [
            'grammaire' => $grammaire,
        ]);
    }

    /**
     * @Route("/grammaire/{id}/edit", name="grammaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Grammaire $grammaire): Response
    {
        $form = $this->createForm(GrammaireType::class, $grammaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grammaire_index');
        }

        return $this->render('grammaire/edit.html.twig', [
            'grammaire' => $grammaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/grammaire/{id}", name="grammaire_delete", methods={"POST"})
     */
    public function delete(Request $request, Grammaire $grammaire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grammaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($grammaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('grammaire_index');
    }
}
