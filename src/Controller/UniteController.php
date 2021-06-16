<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Unite;
use App\Repository\UniteRepository;
use App\Form\UniteType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;



class UniteController extends AbstractController
{
    /**
     * @Route("/unite", name="unite")
     */
    public function index(): Response
    {
        return $this->render('unite/index.html.twig', [
            'controller_name' => 'UniteController',
        ]);
    }
 /**
  * @param UniteRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/afficheunite", name="afficheunite")
  */
     
    public function Affiche (UniteRepository $repository) 
    {

    //$repo=$this->getDoctrine()->getRepository(Unite::class);
    $Unite=$repository->findAll();
    return $this->render('unite/AfficheU.html.twig',
    ['Unite'=>$Unite]);  
    }

    /**
    * @Route ("/deleteunite/{id}", name="deleteunite")
    */

    function Delete($id, UniteRepository $repository){
        $Unite=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Unite);
        $em->flush();
        return $this->redirectToRoute('afficheunite');
    }
        
    /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addunite",name="addunite")
 */
function Add(Request $request){
    $Unite=new Unite();
    $form=$this->createForm(UniteType::class,$Unite);
    $form->add('Add',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($Unite);
        $em->flush();
        return $this->redirectToRoute('afficheunite');
    }
    return $this->render('unite/AddU.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
    /**
 * @Route("/updateunite/{id}", name="updateunite")
 * Method({"GET", "POST"})
 */
 public function update(Request $request, $id) {
    $Unite = new Unite();
    $Unite = $this->getDoctrine()->getRepository(Unite::class)->find($id);
    
    $form = $this->createFormBuilder($Unite)
    ->add('name', TextType::class)
    ->add('emplacement', TextType::class)
    ->add('save', SubmitType::class, array(
    'label' => 'Modifier' 
    ))->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
    
    return $this->redirectToRoute('afficheunite');
    }
            return $this->render('unite/UpdateU.html.twig',[
             'f'=>$form->createView()]);
            }


}
