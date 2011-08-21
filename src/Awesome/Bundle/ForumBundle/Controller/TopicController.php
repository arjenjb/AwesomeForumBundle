<?php

namespace Awesome\Bundle\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awesome\Bundle\ForumBundle\Entity\Topic;
use Awesome\Bundle\ForumBundle\Entity\Reply;

class TopicController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
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
        $topic = new Topic();
        
        $form = $this->createFormBuilder($topic)
            ->add('posterName', null, array('label' => 'Name'))
            ->add('title')
            ->add('message', 'textarea')
            ->getForm();

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST')
        {
            $form->bindRequest($request);

            if ($form->isValid())
            {
                // store the topic
                $topic->setDateChanged(new \DateTime());
                $topic->setDatePosted(new \DateTime());

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($topic);
                $em->flush();

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
        $reply = new Reply();

        $form = $this->createFormBuilder($reply)
            ->add('posterName', null, array('label' => 'Name'))
            ->add('message', 'textarea')
            ->getForm();

        return array(
            'form' => $form->createView()
        );
    }
}
