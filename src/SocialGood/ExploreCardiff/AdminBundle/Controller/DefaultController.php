<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use SocialGood\ExploreCardiff\AdminBundle\Entity\Question;

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
    
    /**
     * @Route("/questions")
     * @Method("POST")
     */
    public function questionsSaveAction() {
        
        $placeId = $this->getRequest()->get('venueId');
        $text = $this->getRequest()->get('question');
        
        $question = new Question;
        
        $place = $this->getDoctrine()
            ->getRepository('SocialGoodExploreCardiffAdminBundle:PlaceOfInterest')
            ->find($placeId);
        
        $question->setPlace($place);
        $question->setDescription($text);
        
        $em = $this->getDoctrine()->getEntityManager();
        
        $em->persist($question);
        
        $em->flush();
        
        return new Response('', 200);
        
    }
    
    /**
     * @Route("/questions/{placeId}")
     * @Method("GET")
     */
    public function questionsAction($placeId)
    {
        $questions = $this->getDoctrine()
            ->getRepository('SocialGoodExploreCardiffAdminBundle:Question')
            ->findBy(array('place'=>$placeId));
        
        $data = array();
        foreach($questions as $question) {
            $dataToAdd = array();
            
            $dataToAdd['question'] = $question->getDescription();
            $answers = array();
            
            foreach($question->getAnswers() as $answer) {
                $answers[] = $answer->getDescription();
            }
            
            $dataToAdd['answers'] = $answers;
            
            $data[] = $dataToAdd;
        }
        
        $response = 'explore_cardiff_answer(';
      
        $response .= (json_encode($data));
        
        $response .= ')';
        
        return new Response($response, 200, array('content-type' => 'text/javascript'));
        
    }
    
    
    
    /**
     * @Route("/questionsForCategory/{categoryId}")
     */
    public function questionsForCategoryAction($categoryId) {
        
        $questionsToReturn = array();
        
        // Get all venues for category
        $places = $this->getDoctrine()
            ->getRepository('SocialGoodExploreCardiffAdminBundle:PlaceOfInterest')
            ->findAll();
        
        $matchedPlaces = array();
        
        foreach($places as $place) {
            foreach($place->getCategories() as $category) {
                if($category->getId() == $categoryId) {
                    $matchedPlaces[] = $place;
                    break;
                }
            }
        }
        
        $questions = array();
        
        foreach($matchedPlaces as $place) {
            
            $questions = array_merge($questions, $place->getQuestions()->toArray());
            
        }
        
        $data = array();
        foreach($questions as $question) {
            $dataToAdd = array();
            
            $dataToAdd['question'] = $question->getDescription();
            $answers = array();
            
            foreach($question->getAnswers() as $answer) {
                $answers[] = $answer->getDescription();
            }
            
            $dataToAdd['answers'] = $answers;
            
            $data[] = $dataToAdd;
        }
        
        $response = 'explore_cardiff_data(';
      
        $response .= (json_encode($data));
        
        $response .= ')';
        
        return new Response($response, 200, array('content-type' => 'text/javascript'));
        
    }
    
}
