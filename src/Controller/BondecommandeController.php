<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Bondecommande;
use App\Repository\BondecommandeRepository;
use App\Form\BondecommandeType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class BondecommandeController extends AbstractController
{
    /**
     * @Route("/bondecommande", name="bondecommande")
     */
    public function index(): Response
    {
        return $this->render('bondecommande/index.html.twig', [
            'controller_name' => 'BondecommandeController',
        ]);
    }
 /**
  * @param BondecommandeRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/affichebondecmd", name="affichebondecmd")
  */
     
    public function Affiche (BondecommandeRepository $repository) 
    {

    //$repo=$this->getDoctrine()->getRepository(Bondecommande::class);
    $Bondecommande=$repository->findAll();
    return $this->render('bondecommande/Affichebondecmd.html.twig',
    ['Bondecommande'=>$Bondecommande]);  
    }

    /**
    * @Route ("/deletebondecmd/{id}", name="deletebondecmd")
    */

    function Delete($id, BondecommandeRepository $repository){
        $Bondecommande=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Bondecommande);
        $em->flush();
        return $this->redirectToRoute('affichebondecmd');
    }
        
    /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addbondecmd",name="addbondecmd")
 */
function Add(Request $request){
    $Bondecommande=new Bondecommande();
    $form=$this->createForm(BondecommandeType::class,$Bondecommande);
    $form->add('Add',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($Bondecommande);
        $em->flush();
        return $this->redirectToRoute('affichebondecmd');
    }
    return $this->render('bondecommande/Addbondecmd.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
     /**
 * @Route("/updatebondecmd/{id}", name="updatebondecmd")
 * Method({"GET", "POST"})
 */
 public function update(Request $request, $id) {
    $Bondecommande = new Bondecommande();
    $Bondecommande = $this->getDoctrine()->getRepository(Bondecommande::class)->find($id);
    
    $form = $this->createFormBuilder($Bondecommande)
    ->add('num', TextType::class)
    ->add('nmbmt', TextType::class)
    ->add('prix', TextType::class)
    ->add('save', SubmitType::class, array(
    'label' => 'Modifier' 
    ))->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
    
    return $this->redirectToRoute('affichebondecmd');
    }

            return $this->render('bondecommande/Updatebondecmd.html.twig',[
             'f'=>$form->createView()]);
            
            
            }
            

/**
  * @param BondecommandeRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route("/afficheebondecmd/{id}", name="afficheebondecmd")
  */
     
  public function AfficheByID (BondecommandeRepository $repository, $id) 
  {
    $Bondecommande = new Bondecommande();
    $Bondecommande = $this->getDoctrine()->getRepository(Bondecommande::class)->find($id);
  
  return $this->render('bondecommande/Consultbondecmd.html.twig',
  ['Bondecommande'=>$Bondecommande]);  
  }
        }
