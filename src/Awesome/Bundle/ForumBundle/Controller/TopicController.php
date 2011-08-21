<?php

namespace Awesome\Bundle\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awesome\Bundle\ForumBundle\Entity\Topic;
use Awesome\Bundle\ForumBundle\Entity\Reply;

/**
 * De Awesome TopicController
 */
class TopicController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        // haal alle topics op en sorteer ze aflopend op de datum waarop ze
        // veranderd zijn
        $topics = $this->getDoctrine()
            ->getEntityManager()
            ->createQuery('SELECT t FROM AwesomeForumBundle:Topic t ORDER BY t.dateChanged DESC')
            ->getResult();
        
        return array(
            'topics' => $topics
        );
    }

    /**
     * @Route("/topic/{id}")
     * @Template
     */
    public function topicAction($id)
    {
        // haal het topic op met het aangegeven $id
        $topic = $this->getDoctrine()
            ->getRepository('AwesomeForumBundle:Topic')
            ->find($id);

        return array(
            'topic' => $topic
        );
    }

    /**
     * @Route("/post")
     * @Template
     */
    public function postAction()
    {
        // maak een nieuw topic aan
        $topic = new Topic();

        // zet het formulier in elkaar
        $form = $this->createFormBuilder($topic)
            ->add('posterName', null, array('label' => 'Name'))
            ->add('title')
            ->add('message', 'textarea')
            ->getForm();

        // haal het request object op
        $request = $this->getRequest();

        // is dit een POST request? Zoja dan heeft de bezoeker het formulier
        // ingevuld en verstuurd
        if ($request->getMethod() == 'POST')
        {
            // bind de request data aan het formulier, zo worden de ingevulde
            // velden gekoppeld aan de attributen van het $topic object
            $form->bindRequest($request);

            // is het formulier juist ingevuld?
            if ($form->isValid())
            {
                // de datum dat het topic gewijzigd is en aangemaakt is naar
                // vandaag
                $topic->setDateChanged(new \DateTime());
                $topic->setDatePosted(new \DateTime());

                // haal de Doctrine EntityManager op en sla het topic op
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($topic);
                $em->flush();

                // stuurt ons door naar de topic pagina voor het net nieuw
                // aangemaakte topic
                return $this->redirect($this->generateUrl('awesome_forum_topic_topic', array('id' => $topic->getId())));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

     /**
     * @Route("/reply/{id}")
     * @Template
     */
    public function replyAction($id)
    {
        // maak eerst een leeg reply aan
        $reply = new Reply();

        // maak het reply formulier
        $form = $this->createFormBuilder($reply)
            ->add('posterName', null, array('label' => 'Name'))
            ->add('message', 'textarea')
            ->getForm();

        // haal het request object op
        $request = $this->getRequest();

        // is dit een POST request? Zoja dan is het formulier verstuurd en
        // moeten we deze verwerken
        if ($request->getMethod() == 'POST')
        {
            // bind de request data aan het formulier, zo worden de ingevulde
            // velden gekoppeld aan de attributen van het $reply object
            $form->bindRequest($request);

            // is het formulier juist ingevuld?
            if ($form->isValid())
            {
                // haal het topic op
                $topic = $this->getDoctrine()
                    ->getRepository('AwesomeForumBundle:Topic')
                    ->find($id);
               
                // pas de changed datum van het topic aan zodat het bovenaan in
                // de topic lijst komt te staan
                $topic->setDateChanged(new \DateTime());

                // maak de relatie tussen de reply en het topic
                $reply->setDatePosted(new \DateTime());
                $reply->setTopic($topic);

                // haal de Doctrine EntityManager op en sla het topic en de
                // reply op
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($topic);
                $em->persist($reply);
                $em->flush();

                // redirect terug naar het topic
                return $this->redirect($this->generateUrl('awesome_forum_topic_topic', array('id' => $topic->getId())));
            }
        }

        // geef het formulier mee aan onze view
        return array(
            'form' => $form->createView()
        );
    }
}
