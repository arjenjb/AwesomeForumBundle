<?php

namespace Awesome\Bundle\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{a}/{b}")
     * @Template()
     */
    public function indexAction($a, $b)
    {
        $y = $a + $b;

        return array('resultaat' => $y);
    }
}

