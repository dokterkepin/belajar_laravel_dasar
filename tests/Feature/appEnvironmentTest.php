<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class appEnvironmentTest extends TestCase
{
  public function testAppEnv(){
      if(App::environment(["dev", "prod", "testing"])){
          // code program
          self::assertTrue(true);
      }
  }
}
