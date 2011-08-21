<?php

namespace Awesome\Bundle\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Awesome\Bundle\ForumBundle\Entity\Topic;

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

        return array(
            'form' => $form->createView()
        );
    }
}
