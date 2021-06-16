<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Intervention;
use App\Repository\InterventionRepository;
use App\Form\InterventionType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;





class InterventionController extends AbstractController
{
    /**
     * @Route("/intervention", name="intervention")
     */
    public function index(): Response
    {
        return $this->render('intervention/index.html.twig', [
            'controller_name' => 'interventionController',
        ]);
    }
 /**
  * @param InterventionRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/afficheintervention", name="afficheintervention")
  */
     
    public function Affiche (InterventionRepository $repository) 
    {

    //$repo=$this->getDoctrine()->getRepository(Intervention::class);
    $Intervention=$repository->findAll();
    return $this->render('intervention/Afficheinter.html.twig',
    ['Intervention'=>$Intervention]);  
    }

    /**
    * @Route ("/deleteintervention/{id}", name="deleteintervention")
    */

    function Delete($id, InterventionRepository $repository){
        $Intervention=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Intervention);
        $em->flush();
        return $this->redirectToRoute('afficheintervention');
    }
        
    /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addintervention",name="addintervention")
 */
function Add(Request $request){
    $Intervention=new Intervention();
    $form=$this->createForm(InterventionType::class,$Intervention);
    $form->add('Ajouter',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($Intervention);
        $em->flush();
        return $this->redirectToRoute('afficheintervention');
    }
    return $this->render('intervention/Addinter.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
    /**
 * @Route("/updateintervention/{id}", name="updateintervention")
 * Method({"GET", "POST"})
 */
 public function update(Request $request, $id) {
    $Intervention = new Intervention();
    $Intervention = $this->getDoctrine()->getRepository(Intervention::class)->find($id);
    
    $form = $this->createFormBuilder($Intervention)
    ->add('date', TextType::class)
    
    ->add('nombrepr', TextType::class)
    //->add('pieces_de_rechange', TextType::class)
    ->add('Save', SubmitType::class, array(
    'label' => 'Mettre à jour' 
    ))->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
    
    
                return $this->redirectToRoute('afficheintervention');
            }
            return $this->render('intervention/Updateinter.html.twig',[
             'f'=>$form->createView()]);
            }

/**
  * @param InterventionRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route("/afficheeinter/{id}", name="afficheeinter")
  */
     
  public function AfficheByID (InterventionRepository $repository, $id) 
  {
    $Intervention = new Intervention();
    $Intervention = $this->getDoctrine()->getRepository(Intervention::class)->find($id);
  
  return $this->render('intervention/Consultinter.html.twig',
  ['Intervention'=>$Intervention]);  
  }

}
