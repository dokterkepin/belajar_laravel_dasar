<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class environmentTest extends TestCase
{
    public function testGetEnv(){
        $youtube = env("YOUTUBE");
        self::assertEquals("kevinChang", $youtube);
    }

    public function testDefaultEnv(){
        $author = env("AUTHOR");
        self::assertEquals("Kevin", $author);
    }
}
