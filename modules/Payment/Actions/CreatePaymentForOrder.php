<?php

namespace Modules\Payment\Actions;

use Modules\Payment\Exceptions\PaymentFailedException;
use Modules\Payment\PaymentGateway;
use Modules\Payment\Payment;
use Modules\Payment\PaymentDetails;
use RuntimeException;

class CreatePaymentForOrder
{
    /**
     * @throws \Modules\Payment\Exceptions\PaymentFailedException
     */
    public function handle(
        int $orderId,
        int $userId,
        int $totalInCents,
        PaymentGateway $paymentGateway,
        string $paymentToken,
    ): Payment {
        $charge = $paymentGateway->charge(new PaymentDetails($paymentToken, $totalInCents, 'Modularization'));

        return Payment::query()->create([
            'total_in_cents' => $totalInCents,
            'status' => 'paid',
            'payment_gateway' => $charge->paymentProvider,
            'payment_id' => $charge->id,
            'user_id' => $userId,
            'order_id' => $orderId,
        ]);
    }
}
