<?php

namespace Href\ShortyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\DBAL\DBALException;
use Href\ShortyBundle\Entity\Short;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;


/**
 * Generates the short versions of the URL which will be then matched with the longer versions.
 *
 * @author Andrey I. Esaulov
 * @package href
 * @version 0.1
 */

class GenerateShortsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('href:shorts:generate')
            ->setDescription('Generate short URLs and write in DB')
            ->addArgument('amount', InputArgument::OPTIONAL, 'How many URLs do you want to generate?')
            ->addOption('write', null, InputOption::VALUE_NONE, 'If set, generated URLs will be written in the DB')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $amount = $input->getArgument('amount') ?:100;

        $testText = 'We will generate ' . $amount . ' short URLs';


        if ($input->getOption('write')) {
            $testText .= "\nAnd we will write them to DB";
        }

        $output->writeln('<info>Starting URL generation</info>');

        $output->writeln($testText);

        $em = $this->getContainer()->get('doctrine')->getManager();
        $shortener = $this->getContainer()->get('href_shorty.shortener.random');


        $progress = $this->getHelperSet()->get('progress');
        $progress->start($output, $amount);
        $i = 0;
        while ($i++ < $amount) {

            $short = new Short();
            $short->setShort($shortener->shorten(''));
            $em->persist($short);

            try {
                $em->flush();
            } catch(DBALException $e) {
                $output->writeln('<error>' . $e->getMessage() . '</error>');
            }

            $progress->advance();
        }

        $progress->finish();



    }
}