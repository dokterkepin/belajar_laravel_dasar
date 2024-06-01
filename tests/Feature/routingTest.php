<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class routingTest extends TestCase
{
    public function testGet(){
        $this->get("/vin")
            ->assertStatus(200)
            ->assertSeeText('Halo Kevin');
    }

    public function testRedirect(){
        $this->get("/tech")
            ->assertRedirect("/vin");
    }


}
