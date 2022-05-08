<?php

namespace App\Traits;

use Xendit\Invoice as XenditInvoice;

trait XenditTrait{
  static public function invoice($transaction) {
    $mode        = env('XENDIT_MODE');
    $ownerId     = $mode === 'production' ? env('XENDIT_OWNER_ID') : env('XENDIT_OWNER_ID_DEV');
    $description = $transaction->description ?? '';
    
    $invoice = XenditInvoice::create([
      'for-user-id'     => $ownerId,
      'external_id'     => $transaction->uuid,
      'amount'          => $transaction->balance,
      'description'     => "Pembayaran: $description",
      'payer_email'     => $transaction->receiver->email,
      'fixed_va'        => true,
      'customer'        => [
        'given_names'     => $transaction->receiver->name,
        'email'           => $transaction->receiver->email,
      ],
      'payment_methods' => [
        'CREDIT_CARD', 'BNI', 'BRI', 'MANDIRI', 'PERMATA',
        'ALFAMART', 'OVO', 'LINKAJA',
      ]
    ]);

    return $invoice;
  }
}