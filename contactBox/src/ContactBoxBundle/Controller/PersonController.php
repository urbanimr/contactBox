<?php

namespace ContactBoxBundle\Controller;

use ContactBoxBundle\Entity\Person;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class PersonController extends Controller
{
    /**
     * @Route("/new" , name="new")
     */
    public function newAction()
    {

        $person = new Person();
        $form = $this->createFormBuilder($person)
            ->setMethod('POST')
            ->setAction($this->generateUrl('save'))
            ->add('name', 'text', array('required' => true, 'label' => 'Imię'))
            ->add('surname', 'text', array('required'=>true, 'label'=> 'Nazwisko'))
            ->add('description', 'text', array('label'=>'Opis'))
            ->add('save','submit',array('label' => 'Dodaj osobę'))
            ->getForm();


        return $this->render('ContactBoxBundle:Person:new.html.twig', array('form' =>$form->createView()));
    }



    /**
     * @Route("/save" , name="save")
     *
     */

    public function saveAction(Request $request){
        $person = new Person();
        $form = $this->createFormBuilder($person)

            ->add('name', 'text', array('required' => true, 'label' => 'Imię'))
            ->add('surname', 'text', array('required'=>true, 'label'=> 'Nazwisko'))
            ->add('description', 'text', array('label'=>'Opis'))
            ->add('save','submit',array('label' => 'Dodaj osobę'))
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $person = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('onePerson', array('id' =>$person->getId()));
        }
    }


    /**
     * @Route("/{id}/modify" , name="modify")
     */
    public function modifyAction(Request $request ,$id)
    {
        $repository = $this->getDoctrine()->getRepository('ContactBoxBundle:Person');
        $person = $repository->find($id);

        $form = $this->createFormBuilder($person)
            ->add('name', 'text')
            ->add('surname', 'text')
            ->add('description', 'text')
            ->add('save', 'submit')
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('allPersons');
        }

        return $this->render('ContactBoxBundle:Person:modify.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/{id}/delete", name="delete")
     */
    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $person = $em->getRepository('ContactBoxBundle:Person')->find($id);
        $em->remove($person);
        $em->flush();


        return $this->redirectToRoute('allPersons');
        //return $this->render('ContactBoxBundle:Person:delete.html.twig', array(
            // ...
        //));
    }

    /**
     * @Route("/{id}", name="onePerson", requirements={"id":"\d+"})
     */
    public function onePersonAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('ContactBoxBundle:Person');
        $person = $repository->find($id);

        return $this->render('ContactBoxBundle:Person:one_person.html.twig', array('person' =>$person));
    }


    /**
     * @Route("/all", name="allPersons")
     */
    public function allPersonsAction()
    {
        $repository = $this->getDoctrine()->getRepository('ContactBoxBundle:Person');
        $allPersons = $repository->findAll();

        //return new Response(var_dump($allPersons));
        return $this->render('ContactBoxBundle:Person:all_persons.html.twig', array('persons' => $allPersons));
    }

}
