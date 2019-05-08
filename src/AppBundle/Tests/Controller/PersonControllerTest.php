<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PersonControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Address Book', $crawler->filter('.container h1')->text());

        $this->assertGreaterThan(
            10,
            $crawler->filter('#persons tbody tr')->count()
        );
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/show/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Person details', $crawler->filter('.card-header')->text());

        $crawler = $client->request('GET', '/show/200');
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/create');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Add new Person', $crawler->filter('h1')->text());
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/update/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Update Person', $crawler->filter('h1')->text());
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Person details', $crawler->filter('.card-header')->text());
        $this->assertContains('Delete', $crawler->filter('.btn-primary')->text());
    }

}
