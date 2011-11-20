<?php

namespace SocialGood\ExploreCardiff\AdminBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('explorecardiff:import')
            ->setDescription('Import places of interest from Foursquare')
            ->addArgument('latitude', InputArgument::REQUIRED, 'The latitude component of the center coordinate')
            ->addArgument('longitude', InputArgument::REQUIRED, 'The longitude component of the center coordinate')
            ->addArgument('radius', InputArgument::REQUIRED, 'The radius within which places of interest will be included')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $latitude = $input->getArgument('latitude');
        $longitude = $input->getArgument('longitude');
        $radius = $input->getArgument('radius');
        
        

        $output->writeln($text);
    }
}