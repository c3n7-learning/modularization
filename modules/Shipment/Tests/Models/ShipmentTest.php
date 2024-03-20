<?php

namespace Modules\Product\Tests\Models;

use Modules\Shipment\Models\Shipment;
use Modules\Shipment\Tests\ShipmentTestCase;

class ShipmentTest extends ShipmentTestCase
{
    public function test_it_creates_a_shipment(): void
    {
        $shipment = new Shipment();

        $this->assertNotNull($shipment);
    }
}
