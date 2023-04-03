<?php

namespace App\Controller\Dashboard;

use App\Entity\Pays;
use App\Form\PaysType;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/pays")
 */
class PaysController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_pays_index", methods={"GET"})
     */
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('dashboard/pays/index.html.twig', [
            'pays' => $paysRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dashboard_pays_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PaysRepository $paysRepository): Response
    {
        $pay = new Pays();
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paysRepository->add($pay, true);

            return $this->redirectToRoute('app_dashboard_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/pays/new.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_pays_show", methods={"GET"})
     */
    public function show(Pays $pay): Response
    {
        return $this->render('dashboard/pays/show.html.twig', [
            'pay' => $pay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dashboard_pays_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pays $pay, PaysRepository $paysRepository): Response
    {
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paysRepository->add($pay, true);

            return $this->redirectToRoute('app_dashboard_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dashboard/pays/edit.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dashboard_pays_delete", methods={"POST"})
     */
    public function delete(Request $request, Pays $pay, PaysRepository $paysRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pay->getId(), $request->request->get('_token'))) {
            $paysRepository->remove($pay, true);
        }

        return $this->redirectToRoute('app_dashboard_pays_index', [], Response::HTTP_SEE_OTHER);
    }
}
