<?php

namespace Modules\Product\Tests\Models;

use Modules\Product\Models\Product;
use Modules\Product\Tests\ProductTestCase;

class ProductTest extends ProductTestCase
{
    public function test_it_creates_a_product(): void
    {
        $product = new Product();

        $this->assertNotNull($product);
    }
}
