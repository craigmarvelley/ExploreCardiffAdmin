<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirect('/admin/dashboard');
    }
    
    /**
     * @Route("/venues")
     */
    public function venuesAction()
    {
        return null;
    }
}
