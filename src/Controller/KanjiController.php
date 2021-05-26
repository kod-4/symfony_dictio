<?php

namespace App\Controller;

use App\Entity\Kanji;
use App\Form\KanjiType;
use App\Repository\KanjiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class KanjiController extends AbstractController
{
    /**
     * @Route("/kanji", name="kanji_index", methods={"GET"})
     */
    public function index(KanjiRepository $kanjiRepository): Response
    {
        return $this->render('kanji/index.html.twig', [
            'kanjis' => $kanjiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/kanji/new", name="kanji_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kanji = new Kanji();
        $form = $this->createForm(KanjiType::class, $kanji);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kanji);
            $entityManager->flush();

            return $this->redirectToRoute('kanji_index');
        }

        return $this->render('kanji/new.html.twig', [
            'kanji' => $kanji,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/kanji/{id}", name="kanji_show", methods={"GET"})
     */
    public function show(Kanji $kanji): Response
    {
        return $this->render('kanji/show.html.twig', [
            'kanji' => $kanji,
        ]);
    }

    /**
     * @Route("/kanji/{id}/edit", name="kanji_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kanji $kanji): Response
    {
        $form = $this->createForm(KanjiType::class, $kanji);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kanji_index');
        }

        return $this->render('kanji/edit.html.twig', [
            'kanji' => $kanji,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/kanji/{id}", name="kanji_delete", methods={"POST"})
     */
    public function delete(Request $request, Kanji $kanji): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kanji->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kanji);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kanji_index');
    }
}
