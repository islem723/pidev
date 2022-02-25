<?php

namespace App\Controller;

use App\Entity\Entrainement;
use App\Form\EntrainementType;

use App\Repository\EntrainementRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrainementController extends AbstractController
{
    /**
     * @Route("/entrainement", name="entrainement")
     */
    public function index(): Response
    {
        return $this->render('entrainement/index.html.twig', [
            'controller_name' => 'EntrainementController',
        ]);
    }
    /**
     * @Route("/add-entrainement", name="add_entrainement")
     */
    public function addEntrainement(Request $request): Response
    {
        $Entrainement = new Entrainement();
        $form = $this->createForm(EntrainementType::class, $Entrainement);
        $form->add('ajouter', SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Entrainement);
            $entityManager->flush();
        }

        return $this->render("Entrainement/Entrainement-form.html.twig", [
            "form_title" => "Ajouter un Entrainement",
            "form_entrainement" => $form->createView(),
        ]);
    }
    /**
     * @Route ("/supprimerentrainement/{id}",name="d1")
     */
    function Delete($id,EntrainementRepository $repository){

        $Entrainement=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Entrainement);
        $em->flush();
        return $this->redirectToRoute('affichentrainement');

    }
    /**
     * @param EntrainementRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/affichentrainementback",name="affichentrainementback")
     */
    public function affich(EntrainementRepository $repository){
        $Entrainement=$repository->findAll();
        return $this->render('Entrainement/affichform-back.html.twig',['Entrainement'=>$Entrainement]);
    }

/**
 * @param EntrainementRepository $repository
 * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
 * @Route ("/affichentrainement",name="affichentrainement")
 */
public function affich1(EntrainementRepository $repository){
    $Entrainement=$repository->findAll();
    return $this->render('Entrainement/affichform-front.html.twig',['Entrainement'=>$Entrainement]);
}
    /**
     * @Route ("/Entrainement/Update/{id}",name="updatee")
     */
    function Update(EntrainementRepository $repository, $id,Request $request)
    {
        $Entrainement=$repository->find($id);
        $form= $this->createForm(EntrainementType::class,$Entrainement);
        $form->add('updatee',SubmitType::class);
        $form->handleRequest($request);
        if( $form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("affichentrainement");
        }
        return $this->render('Entrainement/update.html.twig',['f1' => $form->createView()]);

    }
}
