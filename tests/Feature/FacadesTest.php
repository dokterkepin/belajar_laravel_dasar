<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertSame;

class FacadesTest extends TestCase
{
    public function testConfig(){
        $firstName = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        self::assertEquals($firstName, $firstName2);

        var_dump(Config::all());

    }


    public function testConfigDependency(){
        $config = $this->app->make('config');
        $firstName3 = $config->get("contoh.author.first");

        $firstName = config("contoh.author.first");
        $firstName2 = Config::get("contoh.author.first");

        self::assertEquals($firstName, $firstName2);
        self::assertEquals($firstName, $firstName3);

        var_dump(Config::all());

    }

    public function testFacadeMock(){
        Config::shouldReceive("get")
            ->with("contoh.author.first")
            ->andReturn("Kevin Ganteng");

        $firstName = Config::get("contoh.author.first");
        self::assertEquals("Kevin Ganteng", $firstName);
    }
}
