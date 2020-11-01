<?php

namespace App\Controller;

use App\Entity\Contract;
use App\Form\ContractType;
use App\Repository\ContractRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query\Lexer;

/**
 * @Route("/contract")
 */
class ContractController extends AbstractController
{
    /**
     * @Route("/", name="contract_index", methods={"GET"})
     */
    public function index(ContractRepository $contractRepository): Response
    {
        return $this->render('contract/index.html.twig', [
            'contracts' => $contractRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contract_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contract = new Contract();
        $form = $this->createForm(ContractType::class, $contract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contract);
            $entityManager->flush();

            return $this->redirectToRoute('contract_index');
        }

        return $this->render('contract/new.html.twig', [
            'contract' => $contract,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @route( "/filtr" , name="contract_filtr",methods={"GET"})
     */
    public function filtr (ContractRepository $contractRepository,Request $request): Response
    {

        $name = $request->query->get('name');
        if ($name == "") {
            $string = "No such contracts";
        } else {
            $string = $name;
        }
        /*return $this->render('contract/filtr.html.twig',[
            'contracts' => $contractRepository->findBy(['User'=>$repository->findOneBy(['name'=>$name])])
        ]);*/
        return  $this->render('contract/filtr.html.twig',['contracts'=>$contractRepository->findByExampleField($name),'string'=>$string]);
    }

    /**
     * @Route("/{id}", name="contract_show", methods={"GET"})
     */
    public function show(Contract $contract): Response
    {
        return $this->render('contract/show.html.twig', [
            'contract' => $contract,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contract_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contract $contract): Response
    {
        $form = $this->createForm(ContractType::class, $contract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contract_index');
        }

        return $this->render('contract/edit.html.twig', [
            'contract' => $contract,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="contract_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contract $contract): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contract->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contract);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contract_index');
    }
}
