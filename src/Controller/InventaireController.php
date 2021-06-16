<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Inventaire;
use App\Repository\InventaireRepository;
use App\Form\InventaireType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;





class InventaireController extends AbstractController
{
    /**
     * @Route("/inventaire", name="inventaire")
     */
    public function index(): Response
    {
        return $this->render('inventaire/index.html.twig', [
            'controller_name' => 'InventaireController',
        ]);
    }

    /**
  * @param InventaireRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/afficheinventaire", name="afficheinventaire")
  */
     
  public function Affiche (InventaireRepository $repository) 
  {

  //$repo=$this->getDoctrine()->getRepository(Inventaire::class);
  $Inventaire=$repository->findAll();
  return $this->render('inventaire/Afficheinv.html.twig',
  ['Inventaire'=>$Inventaire]);  
  }

  /**
    * @Route ("/deleteminventaire/{id}", name="deleteinventaire")
    */

    function Delete($id, InventaireRepository $repository){
        $Inventaire=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Inventaire);
        $em->flush();
        return $this->redirectToRoute('afficheinventaire');
    }

     /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addinventaire", name="addinventaire")
 */
function Add(Request $request){
    $Inventaire=new Inventaire();
    $form=$this->createForm(InventaireType::class,$Inventaire);
    $form->add('Add',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($Inventaire);
        $em->flush();
        return $this->redirectToRoute('afficheinventaire');
    }
    return $this->render('inventaire/Addinv.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
    /**
 * @Route("/updateinventaire/{id}", name="updateinventaire")
 * Method({"GET", "POST"})
 */
 public function update(Request $request, $id) {
    $Inventaire = new Inventaire();
    $Inventaire = $this->getDoctrine()->getRepository(Inventaire::class)->find($id);
    
    $form = $this->createFormBuilder($Inventaire)
    ->add('id', TextType::class)
    //->add('unite', TextType::class)
    ->add('save', SubmitType::class, array(
    'label' => 'Modifier' 
    ))->getForm();
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
                return $this->redirectToRoute('afficheinventaire');
            }
            return $this->render('inventaire/Updateinv.html.twig',[
             'f'=>$form->createView()]);
            }
            

}
