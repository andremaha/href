<?php
/**
 * Thanks to Sebastian Göttschkes I can now do the testing with DB much easier
 *
 * @author  Sebastian Göttschkes
 * @see     http://sgoettschkes.blogspot.de/2012/04/testclasses-for-symfony2.html
 */

namespace Href\ShortyBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

abstract class FunctionalTestCase extends WebTestCase {

    protected $client;
    protected $entityManager;

    protected static function initialize() {
        self::createClient();
        $application = new Application(static::$kernel);
        $application->setAutoExit(false);
        self::createDatabase($application);
    }

    private static function createDatabase($application) {
        self::executeCommand($application, "doctrine:schema:drop", array("--force" => true));
        self::executeCommand($application, "doctrine:schema:create");
        self::executeCommand($application, "doctrine:fixtures:load", array("--fixtures" => __DIR__ . "/../DataFixtures/ORM/"));
    }

    private static function executeCommand($application, $command, Array $options = array()) {
        $options["-e"] = "test";
        //$options["-q"] = null;
        $options["-n"] = null;
        $options = array_merge($options, array('command' => $command));
        return $application->run(new ArrayInput($options));
    }

    public function setUp() {
        self::initialize();
        $this->populateVariables();
    }

    protected function populateVariables() {
        $this->client = static::createClient();
        $container = static::$kernel->getContainer();
        $this->entityManager = $container->get('doctrine')->getEntityManager();
    }

}