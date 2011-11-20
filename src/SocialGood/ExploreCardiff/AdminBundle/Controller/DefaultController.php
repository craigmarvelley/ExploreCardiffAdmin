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
            $thisVenueData = $place->toArray();
            $thisVenueData['challenges'] = $this->challengesForPlace($place->getId());
            $data[] = $thisVenueData;
            
        }
        
        $response = 'explore_cardiff_data(';
      
        $response .= (json_encode($data));
        
        $response .= ')';
        
        return new Response($response, 200, array('content-type' => 'text/javascript'));
        
    }
    
    /**
     * @Route("/categories")
     */
    public function categoriesAction()
    {
        $categories = $this->getDoctrine()
            ->getRepository('SocialGoodExploreCardiffAdminBundle:Category')
            ->findAll();
        
        $data = array();
        foreach($categories as $category) {
            $data[] = $category->toArray();
        }
        
        $response = 'explore_cardiff_data(';
      
        $response .= (json_encode($data));
        
        $response .= ')';
        
        return new Response($response, 200, array('content-type' => 'text/javascript'));
        
    }
    
    public function challengesForPlace($placeId)
    {
        $challenges = $this->getDoctrine()
            ->getRepository('SocialGoodExploreCardiffAdminBundle:Challenge')
            ->findBy(array('place'=>$placeId));
        
        $data = array();
        foreach($challenges as $challenge) {
            $data[] = $challenge->toArray();
        }
        
        return $data;
        
    }
    
}
