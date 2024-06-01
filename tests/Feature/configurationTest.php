<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Seld\PharUtils\Linter;
use Tests\TestCase;

class configurationTest extends TestCase
{
    public function testConfig(){
        $firstname = config("contoh.author.first");
        $lastname = config("contoh.author.last");
        $email = config("contoh.email");
        $web = config("contoh.web");

        self::assertEquals("Kevin", $firstname);
        self::assertEquals("Chang", $lastname);
        self::assertEquals("jiaokevinzhang@gmail.com", $email);
        self::assertEquals("https://github.com/dokterkepin", $web);

    }
}
