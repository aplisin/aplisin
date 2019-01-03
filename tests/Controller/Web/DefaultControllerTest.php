<?php

namespace App\Tests\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class DefaultControllerTest
 */
class DefaultControllerTest extends WebTestCase
{
    public function testIndexAction(): void
    {
        $client = static::createClient();
        $crawlet = $client->request('GET', '/');

        $this->assertNotEmpty($crawlet->count());
    }
}
