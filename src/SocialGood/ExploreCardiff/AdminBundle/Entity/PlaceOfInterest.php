<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SocialGood\ExploreCardiff\AdminBundle\Entity\PlaceOfInterest
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PlaceOfInterest
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $fsid
     *
     * @ORM\Column(name="fsid", type="string")
     */
    private $fsid;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float $latitude
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float $longitude
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;
    
    /**
     * @ORM\OneToMany(targetEntity="Trivia", mappedBy="place")
     */
    private $trivia;
    
    /**
     * @ORM\OneToMany(targetEntity="Challenge", mappedBy="place")
     */
    private $challenges;
    
    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="places", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="places_categories")
     */
    private $categories;
    
    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="place")
     */
    private $questions;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set fsid
     *
     * @param integer $fsid
     */
    public function setFsid($fsid)
    {
        $this->fsid = $fsid;
    }

    /**
     * Get fsid
     *
     * @return integer 
     */
    public function getFsid()
    {
        return $this->fsid;
    }
    
    public function __construct()
    {
        $this->trivia = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add trivia
     *
     * @param SocialGood\ExploreCardiff\AdminBundle\Entity\Trivia $trivia
     */
    public function addTrivia(\SocialGood\ExploreCardiff\AdminBundle\Entity\Trivia $trivia)
    {
        $this->trivia[] = $trivia;
    }
    
    public function toArray() {
        
        $trivia = array();
        
        foreach($this->trivia->toArray() as $triviaObj) {
            $trivia[] = $triviaObj->getDescription();
        }
        
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'trivia' => $trivia
        );
        
    }

    /**
     * Get trivia
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTrivia()
    {
        return $this->trivia;
    }
    
    public function __toString() {
        
        return $this->name;
        
    }

    /**
     * Add categories
     *
     * @param SocialGood\ExploreCardiff\AdminBundle\Entity\Category $categories
     */
    public function addCategory(\SocialGood\ExploreCardiff\AdminBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    }

    /**
     * Get categories
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add challenges
     *
     * @param SocialGood\ExploreCardiff\AdminBundle\Entity\Challenge $challenges
     */
    public function addChallenge(\SocialGood\ExploreCardiff\AdminBundle\Entity\Challenge $challenges)
    {
        $this->challenges[] = $challenges;
    }

    /**
     * Get challenges
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChallenges()
    {
        return $this->challenges;
    }

    /**
     * Add questions
     *
     * @param SocialGood\ExploreCardiff\AdminBundle\Entity\Question $questions
     */
    public function addQuestion(\SocialGood\ExploreCardiff\AdminBundle\Entity\Question $questions)
    {
        $this->questions[] = $questions;
    }

    /**
     * Get questions
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}