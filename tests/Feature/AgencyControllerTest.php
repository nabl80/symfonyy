<?php

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AgencyControllerTest extends WebTestCase
{
    public function testAgencyList()
    {
        $client = static::createClient();
        $client->request('GET', '/agency');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Agency index');
    }
}
