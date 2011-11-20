<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialGood\ExploreCardiff\AdminBundle\Entity\Trivia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Trivia
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
     * @ORM\ManyToOne(targetEntity="PlaceOfInterest", inversedBy="trivia")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     */
    private $place;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * Set placeId
     *
     * @param integer $placeId
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * Get placeId
     *
     * @return integer 
     */
    public function getPlaceId()
    {
        return $this->placeId;
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
     * Set place
     *
     * @param SocialGood\ExploreCardiff\AdminBundle\Entity\PlaceOfInterest $place
     */
    public function setPlace(\SocialGood\ExploreCardiff\AdminBundle\Entity\PlaceOfInterest $place)
    {
        $this->place = $place;
    }

    /**
     * Get place
     *
     * @return SocialGood\ExploreCardiff\AdminBundle\Entity\PlaceOfInterest 
     */
    public function getPlace()
    {
        return $this->place;
    }
    
}