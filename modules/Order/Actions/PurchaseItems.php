<?php

namespace Modules\Order\Actions;

use Illuminate\Validation\ValidationException;
use Modules\Order\Exceptions\PaymentFailedException;
use Modules\Order\Models\Order;
use Modules\Payment\PayBuddy;
use Modules\Product\CartItemCollection;
use Modules\Product\Warehouse\ProductStockManager;
use RuntimeException;

class PurchaseItems
{
    public function __construct(
        protected ProductStockManager $productStockManager
    ) {
    }

    public function handle(CartItemCollection $items, PayBuddy $paymentProvider, string $paymentToken, int $user_id): Order
    {
        $orderTotalInCents = $items->totalInCents();

        try {
            $charge = $paymentProvider->charge($paymentToken, $orderTotalInCents, 'Modularization');
        } catch (RuntimeException) {
            throw PaymentFailedException::dueToInvalidToken();
        }

        $order = Order::query()->create([
            'status' => 'completed',
            'total_in_cents' => $orderTotalInCents,
            'user_id' => $user_id,
        ]);

        foreach ($items->items() as $cartItem) {
            $this->productStockManager->decrement($cartItem->product->id, $cartItem->quantity);

            $order->lines()->create([
                'product_id' => $cartItem->product->id,
                'product_price_in_cents' => $cartItem->product->priceInCents,
                'quantity' => $cartItem->quantity
            ]);
        }

        $payment = $order->payments()->create([
            'total_in_cents' => $orderTotalInCents,
            'status' => 'paid',
            'payment_gateway' => 'PayBuddy',
            'payment_id' => $charge['id'],
            'user_id' => $user_id,
        ]);

        return $order;
    }
}
