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

    public function testFallback(){
        $this->get("/tiada")
            ->assertSeeText("404 by Kevin Chang");
    }

    public function testRouteParameter(){
        $this->get("/products/1")
            ->assertSeeText("Product 1");

        $this->get("/products/2")
            ->assertSeeText("Product 2");

        $this->get("/products/oreo/items/2")
            ->assertSeeText("Product oreo, item 2");
    }
    public function testRouteParameterRegex(){
        $this->get("/categories/1")
            ->assertSeeText("Category: 1");

        $this->get("/categories/chocolate")
            ->assertSeeText("404 by Kevin Chang");
    }

    public function testRouteOptionalParameter(){
        $this->get("/users/")
            ->assertSeeText("User: 404");

        $this->get("/users/kevin")
            ->assertSeeText("User: kevin");
    }

    public function testRouteConflict(){
//        $this->get("/conflict/kevin")
//            ->assertSeeText("Conflict: kevin");

        $this->get("/conflict/kevin")
            ->assertSeeText("Conflict: Kevin Chang");
    }

    public function testNamedRoute(){
        $this->get("/product-expand/12345")->assertSeeText("Link: http://localhost/products/12345");
        $this->get("/product-expand-redirect/12345")->assertRedirect("/products/12345");
    }






}
