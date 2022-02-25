<?php

namespace App\Controller;
use App\Entity\Jeux;
use App\Repository\JeuxRepository;
use App\Form\JeuxType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JeuxController extends AbstractController
{
    /**
     * @Route("/jeux", name="jeux")
     */
    public function index(): Response
    {
        return $this->render('jeux/index.html.twig', [
            'controller_name' => 'JeuxController',
        ]);
    }



    /**
     * @param JeuxRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/affichjeuxback",name="affichjeuxback")
     */
    public function affich1(JeuxRepository $repository){
        $Jeux=$repository->findAll();
        return $this->render('jeux/affichform-back.html.twig',['Jeux'=>$Jeux]);
    }


    /**
     * @param JeuxRepository $repository
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/affichjeux",name="affichjeux")
     */
    public function affich(JeuxRepository $repository){
        $Jeux=$repository->findAll();
        return $this->render('jeux/affichform.html.twig',['Jeux'=>$Jeux]);
    }
    /**
     * @Route("/add-jeux", name="add_jeux")
     */
    public function addJEUX(Request $request): Response
    {
        $Jeux = new Jeux();
        $form = $this->createForm(JeuxType::class, $Jeux);
        $form->add('ajouter', SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        { $uploadedFile = $form['image']->getData();
            $filename = md5(uniqid()).'.'.$uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('upload_directory'),$filename);
            $Jeux->setImage($filename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Jeux);
            $entityManager->flush();
            return $this->redirectToRoute('affichjeuxback');

        }

        return $this->render("jeux/jeux-form.html.twig", [
            "form_title" => "Ajouter un jeu",
            "form_jeux" => $form->createView(),
        ]);
    }
    /**
     * @Route ("/supprimer/{id}",name="d")
     */
    function Delete($id,JeuxRepository $repository){

        $Jeux=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Jeux);
        $em->flush();
        return $this->redirectToRoute('affichjeux');

}

    /**
     * @Route ("Jeux/Update/{id}",name="update")
     */
    function Update(JeuxRepository $repository, $id,Request $request)
    {
        $Jeux=$repository->find($id);
        $form= $this->createForm(JeuxType::class,$Jeux);
        $form->add('update',SubmitType::class);
        $form->handleRequest($request);
        if( $form->isSubmitted()&& $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("affichjeux");
        }
        return $this->render('Jeux/update.html.twig',['f' => $form->createView()]);

    }

}
