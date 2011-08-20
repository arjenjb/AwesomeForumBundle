<?php

namespace Awesome\Bundle\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
            ->createQuery('SELECT t FROM AwesomeForumBundle:Topic t ORDER BY t.dateChanged')
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
}
