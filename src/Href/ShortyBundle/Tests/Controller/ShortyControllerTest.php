<?php

namespace Href\ShortyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Href\ShortyBundle\Tests\FunctionalTestCase;

class ShortyControllerTest extends FunctionalTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        // Testing that the rendering works
        $this->assertGreaterThan(
            0,
            $crawler->filter('h1:contains("Generate new URL")')->count()
        );

        // Testing that the fixtures get written correctly
        $this->assertGreaterThan(
            0,
            $crawler->filter('.top_domains')->first('li:contains("lenta.ru")')->count()
        );

        $this->assertGreaterThan(
            0,
            $crawler->filter('.top_tlds')->first('li:contains("ru")')->count()
        );

        // Test if submitting a form works
        $form = $crawler->selectButton('submit')->form();
        $form['url[original]'] = 'http://symfony.com/doc/master/book/testing.html';

        $crawler = $client->submit($form);

        // A response should be a redirect to url_success route
        $this->assertTrue(
            $client->getResponse()->isRedirect()
        );

        $successURL = $crawler->filter('a')->extract('_text', 'href');

        $crawler = $client->request('GET', $successURL[0]);

        // We should land on the success page
        $this->assertGreaterThan(
            0,
            $crawler->filter('h1:contains("Your very own short URL is")')->count()
        );

        // Success page should have the link to the url stats
        $link = $crawler->filter('a.url_stats')->link();
        $crawler  = $client->click($link);

        $this->assertGreaterThan(
            0,
            $crawler->filter('h1:contains("Stats for Link")')->count()
        );

        // The all time clicks statistics should be 0 for the new link
        $this->assertEquals(
            0,
            $crawler->filter('.all_time_clicks')->text()
        );

    }

    public function testShow()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/Ga4U0d/stats');

        // This is in fact the statistics for the generated URL from fixtures

        // Generated URL matches
        $this->assertGreaterThan(
            0,
            $crawler->filter('.generated_url:contains("Ga4U0d")')->count()
        );

        // Original URL matches
        $this->assertGreaterThan(
            0,
            $crawler->filter('.original_url:contains("http://lenta.ru/news/2013/01/19/biathlon/")')->count()
        );

        // The statistics for the URL is 0, since it has not been clicked
        $this->assertEquals(
            0,
            $crawler->filter('.all_time_clicks')->text()
        );

        // Clicking the generated URL redirects to the original URL
        $link = $crawler->filter('a.generated_url')->link();
        $client->click($link);
        $this->assertTrue(
            $client->getResponse()->isRedirect('http://lenta.ru/news/2013/01/19/biathlon/')
        );

        // Go back and check the stats have changed
        $crawler = $client->back();

        $this->assertEquals(
            1,
            $crawler->filter('.all_time_clicks')->text()
        );

        // Clicking the generated URL adds it to the TOP 10 URLs column on the homepage
        $crawler = $client->request('GET', '/');
        $this->assertEquals(
            1,
            $crawler->filter('.top_urls')->children()->count()
        );
    }

}
