<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use SocialGood\ExploreCardiff\AdminBundle\Entity\PlaceOfInterest;
use SocialGood\ExploreCardiff\AdminBundle\Entity\Category;

require(__DIR__.'/../../../../../vendor/foursquareasync/EpiCurl.php');
require(__DIR__.'/../../../../../vendor/foursquareasync/EpiFoursquare.php');

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('explorecardiff:import')
            ->setDescription('Import places of interest from Foursquare')
            ->addArgument('radius', InputArgument::REQUIRED, 'The radius within which places of interest will be included')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $radius = $input->getArgument('radius');
        
        $latitude = 51.4824;
        $longitude = -3.1811;
        
        $output->write("Searching for venues..");
        
        $fsObj = new \EpiFoursquare('ED5EZC1KM5MXGV1E43MU42IMYZ2Y2EBCF0WUYXVQRN2QETB4', 'AH2NLG5HFNQRJQKQHZUSFBPQBRBLVJB122CMD1AXLJFF2ZBH');
        
        $data = $fsObj->get('/venues/search', array('ll' => sprintf('%s,%s', $latitude, $longitude), 'radius' => $radius));
        
        $venues = $data->response->groups[0]->items;
        
        $doctrine = $this->getContainer()->get('doctrine');
        
        $em = $doctrine->getEntityManager('default');
        $em->getConnection()->exec($em->getConnection()->getDatabasePlatform()->getTruncateTableSql('PlaceOfInterest'));
        $em->getConnection()->exec($em->getConnection()->getDatabasePlatform()->getTruncateTableSql('places_categories'));
        $em->getConnection()->exec($em->getConnection()->getDatabasePlatform()->getTruncateTableSql('Trivia'));
        
        $existingCategories = $doctrine
            ->getRepository('SocialGoodExploreCardiffAdminBundle:Category')
            ->findAll();
        
        if(! $existingCategories) {
            $existingCategories = array();
        }
        
        foreach($venues as $venue) {
            
            $place = new PlaceOfInterest;
            $place->setName($venue->name);
            $place->setLatitude($venue->location->lat);
            $place->setLongitude($venue->location->lng);
            $place->setFsid($venue->id);
            
            foreach($venue->categories as $categoryData) {
                
                $found = false;
                foreach($existingCategories as $existingCategory) {
                    if($categoryData->id == $existingCategory->getId()) {
                        $place->addCategory($existingCategory);
                        $found = true;
                        break;
                    }
                }
                
                if($found) {
                    continue;
                }
                
                $category = new Category();
                $category->setId($categoryData->id);
                $category->setName($categoryData->name);
                $category->setImageURL($categoryData->icon);
                
                $place->addCategory($category);
                
                $existingCategories[] = $category;
                
                
            }
            
            $em->persist($place);
            
        }
        
        $em->flush();

    }
}