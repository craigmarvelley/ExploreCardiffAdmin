<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SocialGood\ExploreCardiff\AdminBundle\Entity\Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
    /**
     * @ORM\ManyToMany(targetEntity="PlaceOfInterest", mappedBy="categories")
     */
    private $places;

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
    public function __construct()
    {
        $this->places = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add places
     *
     * @param SocialGood\ExploreCardiff\AdminBundle\Entity\PlaceOfInterest $places
     */
    public function addPlaceOfInterest(\SocialGood\ExploreCardiff\AdminBundle\Entity\PlaceOfInterest $places)
    {
        $this->places[] = $places;
    }

    /**
     * Get places
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPlaces()
    {
        return $this->places;
    }

    /**
     * Add places
     *
     * @param SocialGood\ExploreCardiff\AdminBundle\Entity\Place $places
     */
    public function addPlace(\SocialGood\ExploreCardiff\AdminBundle\Entity\Place $places)
    {
        $this->places[] = $places;
    }
}