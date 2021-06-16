<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Piecesderechange;
use App\Repository\PiecesderechangeRepository;
use App\Form\PiecesderechangeType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class PiecesderechangeController extends AbstractController
{
    /**
     * @Route("/pieces", name="pieces")
     */
    public function index(): Response
    {
        return $this->render('piecesderechange/index.html.twig', [
            'controller_name' => 'PiecesderechangeController',
        ]);
    }
 /**
  * @param PiecesderechangeRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/affichepieces", name="affichepieces")
  */
     
    public function Affiche (PiecesderechangeRepository $repository) 
    {

    //$repo=$this->getDoctrine()->getRepository(Piecesderechange::class);
    $Piecesderechange=$repository->findAll();
    return $this->render('piecesderechange/Affichepieces.html.twig',
    ['Piecesderechange'=>$Piecesderechange]);  
    }

    /**
    * @Route ("/deletepieces/{id}", name="deletepieces")
    */

    function Delete($id, PiecesderechangeRepository $repository){
        $Piecesderechange=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Piecesderechange);
        $em->flush();
        return $this->redirectToRoute('affichepieces');
    }
        
    /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addpieces",name="addpieces")
 */
function Add(Request $request){
    $Piecesderechange=new Piecesderechange();
    $form=$this->createForm(PiecesderechangeType::class,$Piecesderechange);
    $form->add('Add',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($Piecesderechange);
        $em->flush();
        return $this->redirectToRoute('affichepieces');
    }
    return $this->render('piecesderechange/Addpieces.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
   /**
 * @Route("/updatepieces/{id}", name="updatepieces")
 * Method({"GET", "POST"})
 */
 public function update(Request $request, $id) {
    $Piecesderechange = new Piecesderechange();
    $Piecesderechange = $this->getDoctrine()->getRepository(Piecesderechange::class)->find($id);
    
    $form = $this->createFormBuilder(Piecesderechange)
    ->add('nom', TextType::class)
    
    ->add('save', SubmitType::class, array(
    'label' => 'Modifier' 
    ))->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
                return $this->redirectToRoute('affichepieces');
            }
            return $this->render('piecesderechange/Updatepieces.html.twig',[
             'f'=>$form->createView()]);
            }


}

