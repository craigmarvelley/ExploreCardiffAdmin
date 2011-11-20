<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
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
        $places = $this->getDoctrine()
            ->getRepository('SocialGoodExploreCardiffAdminBundle:PlaceOfInterest')
            ->findAll();
        
        $data = array();
        foreach($places as $place) {
            $data[] = $place->toArray();
        }
      
        return new Response(json_encode($data));
    }
}
