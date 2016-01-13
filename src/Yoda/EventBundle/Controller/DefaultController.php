<?php

namespace Yoda\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Yoda\EventBundle\Entity\Event;

class DefaultController extends Controller
{
    public function indexAction($name, $count)
    {
        $em = $this->getDoctrine()->getManager();

        //Create new event
        /*$event = new Event();
        $event->setName('Darth\'s surprise birthday party!');
        $event->setLocation('Deathstar');
        $event->setTime(new \DateTime('tomorrow noon'));
        $event->setDetails('Darth HATES surprises!!');

        $em->persist($event);
        $em->flush(); //Commits the db operation*/

        $repo = $em->getRepository('EventBundle:Event'); //Repo -> Helps query for a type of object
        $event = $repo->findOneBy(array(
            'name' => 'Darth\'s surprise birthday party!'
        ));



        return $this->render('EventBundle:Default:index.html.twig', array(
            'name' => $name,
            'count' => $count,
            'event' => $event
            ));
        $data = array(
            'count' => $count,
            'name' => $name,
            'ackbar' => 'It\'s a traaaaaap!'
        );
        $json = json_encode($data);

        $response = new Response($json);
        $response->headers->set('Content-Type', 'application/json');

        //$this->container *only* works in Controllers
//        $templating = $this->container->get('templating'); //Example of using services
//
//        $content = $templating->renderResponse(
//            'EventBundle:Default:index.html.twig',
//            array('name' => $name,
//                  'count' => $count)
//        );

    }
}
