<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTesr extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGetAllCategories()
    {
        factory(Laztopaz\Model\Category::class)->make();
        $response = $this->call('GET', '/v1/categories');

        $categories = json_decode($response->getContent(), true);

        $this->assertGreaterThan(0, count($categories));
    }

    public function testGetASingleCategory()
    {
        $category = factory(Laztopaz\Model\Category::class)->create();
        $response = $this->call('GET', '/v1/categories/'.$category->id);

        $jsonCategory = json_decode($response->getContent(), true);

        $this->assertEquals($category->id, $jsonCategory['id']);
        $this->assertEquals($category->name, $jsonCategory['name']);
        $this->assertEquals($category->description, $jsonCategory['description']);
        $this->assertGreaterThan(0, count($jsonCategory));
    }
}
