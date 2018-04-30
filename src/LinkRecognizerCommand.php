<?php

namespace LinkRecognizer;

use LinkRecognizer\LinkRecognizer;
use LinkRecognizer\Database\LocalXMLDatabase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class LinkRecognizerCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('recognize')
            ->setDescription('Recognize some product given some link')

            ->addArgument('xml-path', InputArgument::REQUIRED, 'Path where XML of the shops are stored.')
            ->addArgument('shop-name', InputArgument::REQUIRED, 'Shop name.')
            ->addArgument('visited-link', InputArgument::REQUIRED, 'Visited link to find product on given Shop.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $xmlPath = $input->getArgument('xml-path');
        $shopName = $input->getArgument('shop-name');
        $visitedLink = $input->getArgument('visited-link');

        $database = new LocalXMLDatabase($xmlPath);
        $linkRecognizer = new LinkRecognizer($database);

        try {
            $product = $linkRecognizer->recognize($shopName, $visitedLink);
        } catch (\Exception $e) {
            $output->writeln('Error to recognize product');
            return false;
        }

        $output->writeln('Product ID: ' . $product->getId());
        $output->writeln('Product title: ' . $product->getTitle());
        return true;
    }
}