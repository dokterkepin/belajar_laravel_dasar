<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;

class serviceContainerTest extends TestCase
{
    public function testDependency(){
        $foo = $this->app->make(Foo::class); // as if create $foo = new Foo()
        $foo2 = $this->app->make(Foo::class);

        self::assertEquals("Foo", $foo->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo, $foo2);
    }

    public function testBind(){
        $this->app->bind(Person::class, function($app){
            return new Person("Kevin", "Chang");
        });

        $person = $this->app->make(Person::class); // closure() // new Person("Kevin", "Chang");
        $person2 = $this->app->make(Person::class); // closure() // new Person("Kevin", "Chang");

        self::assertEquals("Kevin", $person->firstName);
        self::assertEquals("Kevin", $person2->firstName);
        self::assertNotSame($person, $person2);
    }

    public function testSingleton(){
        $this->app->singleton(Person::class, function($app){
           return new Person("Kevin", "Chang");
        });

        $person = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Kevin", $person->firstName); // new Person("Kevin", "Chang"); if not exists
        self::assertEquals("Kevin", $person2->firstName); // return existing
        self::assertSame($person, $person2);
    }

    public function testInstance(){
        $objPerson = new Person("Kevin", "Chang");
        $this->app->instance(Person::class, $objPerson);

        $person = $this->app->make(Person::class); //$objPerson
        $person2 = $this->app->make(Person::class); // $objPerson

        self::assertEquals("Kevin", $person->firstName);
        self::assertEquals("Kevin", $person2->firstName);
        self::assertSame($person, $person2);
    }

    public function testDependencyInjection(){
        $this->app->singleton(Foo::class, function($app){
            return new Foo;
        });

        $this->app->singleton(Bar::class, function($app){
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar->foo);
        self::assertSame($bar, $bar2);
    }

    public function testInterfaceToClass(){
        // $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);
        $this->app->singleton(HelloService::class, function($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo Kevin", $helloService->hello("Kevin"));
    }
}
