<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Materiel;
use App\Repository\MaterielRepository;
use App\Form\MaterielType;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class MaterielController extends AbstractController
{
    /**
     * @Route("/materiel", name="materiel")
     */
    public function index(): Response
    {
        return $this->render('materiel/index.html.twig', [
            'controller_name' => 'MaterielController',
        ]);
    }

    /**
  * @param MaterielRepository $repository 
  * @return \Symfony\Component\HttpFoundation\Response
  * @Route ("/affichemateriel", name="affichemateriel")
  */
     
  public function Affiche (MaterielRepository $repository) 
  {

  //$repo=$this->getDoctrine()->getRepository(Materiel::class);
  $Materiel=$repository->findAll();
  return $this->render('materiel/AfficheM.html.twig',
  ['Materiel'=>$Materiel]);  
  }

  /**
    * @Route ("/deletemateriel/{id}", name="deletemateriel")
    */

    function Delete($id, MaterielRepository $repository){
        $Materiel=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Materiel);
        $em->flush();
        return $this->redirectToRoute('affichemateriel');
    }

     /**
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 * @Route("/addmateriel", name="addmateriel")
 */
function Add(Request $request){
    $Materiel=new Materiel();
    $form=$this->createForm(MaterielType::class,$Materiel);
    $form->add('Add',SubmitType::class);
    $form->handleRequest($request);
   if ($form->isSubmitted() && $form->isValid() ){
        $em=$this->getDoctrine()->getManager();
        $em->persist($Materiel);
        $em->flush();
        return $this->redirectToRoute('affichemateriel');
    }
    return $this->render('materiel/AddM.html.twig',[
        'form'=>$form->createView()
    ]);
    }    
    
/**
 * @Route("/updatemateriel/{id}", name="updatemateriel")
 * Method({"GET", "POST"})
 */
public function update(Request $request, $id) {
    $Materiel = new Materiel();
    $Materiel = $this->getDoctrine()->getRepository(Materiel::class)->find($id);
    
    $form = $this->createFormBuilder($Materiel)
    ->add('type', TextType::class)
    ->add('date_dacquisition', TextType::class)
    ->add('affectation', TextType::class)
    ->add('etat', TextType::class)
    //->add('unite', TextType::class)
    //->add('inventaire', TextType::class)
    //->add('bon_de_commande', TextType::class)
    //->add('intervention', TextType::class)
    ->add('save', SubmitType::class, array(
        'label' => 'Modifier' 
        ))->getForm();

    
    
    
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()) {
    
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->flush();
                return $this->redirectToRoute('affichemateriel');
            }
            return $this->render('materiel/UpdateM.html.twig',[
             'f'=>$form->createView()]);
            }
            /** 
            * @Route ("/admin", name="admin")
            * @IsGranted("ROLE_ADMIN")
            */

            public function Admin(){
                
                
                $materiels = $this->getDoctrine()->getRepository(Materiel::class)->findAll();
                $users = $this->getDoctrine()->getRepository(User::class)->findAll();

                return $this->render('admin/index.html.twig', [
                    'materiels'=> $materiels,
                    'users'=>$users
                ]);


            }

}

