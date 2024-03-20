<?php

namespace Modules\Product\Tests\Models;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Product\Database\Factories\ProductFactory;
use Modules\Product\Models\Product;
use Modules\Product\Tests\ProductTestCase;

class ProductTest extends ProductTestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_product(): void
    {
        // $product = ProductFactory::new()->create();
        $product = Product::factory()->create();


        $product = new Product();

        $this->assertNotNull($product);
    }
}
