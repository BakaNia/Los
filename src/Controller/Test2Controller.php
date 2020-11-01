<?php

namespace App\Controller;

use App\Entity\Test2;
use App\Form\Test2Type;
use App\Repository\Test2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test2")
 */
class Test2Controller extends AbstractController
{
    /**
     * @Route("/", name="test2_index", methods={"GET"})
     */
    public function index(Test2Repository $test2Repository): Response
    {
        return $this->render('test2/index.html.twig', [
            'test2s' => $test2Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="test2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $test2 = new Test2();
        $form = $this->createForm(Test2Type::class, $test2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($test2);
            $entityManager->flush();

            return $this->redirectToRoute('test2_index');
        }

        return $this->render('test2/new.html.twig', [
            'test2' => $test2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test2_show", methods={"GET"})
     */
    public function show(Test2 $test2): Response
    {
        return $this->render('test2/show.html.twig', [
            'test2' => $test2,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="test2_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Test2 $test2): Response
    {
        $form = $this->createForm(Test2Type::class, $test2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test2_index');
        }

        return $this->render('test2/edit.html.twig', [
            'test2' => $test2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test2_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Test2 $test2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$test2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($test2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('test2_index');
    }
}
