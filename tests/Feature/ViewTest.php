<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testView()
    {
        $this->get("/hello")
            ->assertSeeText("Hello Kevin");

        $this->get("/hello-again")
            ->assertSeeText("Hello Kevin Chang");
    }

    public function testNested(){
        $this->get("/hello-world")
            ->assertSeeText("World Kevin");

    }

    public function testTemplate(){
        $this->view("hello.world", ["name" => "Kevin Chang"])
            ->assertSeeText("World Kevin Chang");
    }

}
