<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorException as Error;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\{Addon, Destination, Transaction, User};
use App\Traits\Api\RequestValidator;
use App\Traits\XenditTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    use RequestValidator;

    public function store(Request $request) {
        try{
            $this->validate($request, [
                'destination_id'    => 'required|exists:destinations,id',
                'addons_id'         => 'nullable|exists:addons,id',
                'first_name'        => 'required|min:2|max:20',
                'last_name'         => 'required|min:2|max:20',
                'email'             => 'required|email|unique:users,email',
                'phone'             => 'required|min:10|max:20',
                'birth_date'        => 'required|date',
                'gender'            => 'required|in:1,2',
                'id_card_type'      => 'required|min:3|max:20',
                'id_card_number'    => 'required|min:6|max:20',
                'blood_type'        => 'nullable|min:1|max:3',
            ]);
            
            // CREATE USER
            $user = User::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'password'      => Hash::make('password123'),
                'phone'         => $request->phone,
                'birth_date'    => $request->birth_date,
                'gender'        => $request->gender,
            ]);

            $user->update([
                'detail' => collect($request)->except(
                    collect($user)->keys()
                )
            ]);

            // CREATE TRANSACTION
            $destination = Destination::find($request->destination_id);
            $addon       = Addon::find($request->addons_id ?? null);
            $transaction = $user->receiveTransactions()->create([
                'amount'    => $destination->price + ($addon->price ?? 0),
                'type'      => 2,
            ]);
 
            if($destination) $transaction->destination()->create([
                'destination_id'    => $destination->id,
                'price'             => $destination->price,
            ]);
            
            if($addon) $transaction->addon()->create([
                'addon_id'  => $addon->id,
                'price'     => $addon->price,
            ]);

            $invoice = XenditTrait::invoice($transaction);
            $transaction->update([
                'detail'    => ['invoices' => [
                    'pending'=> $invoice,
                ]],
            ]);

            return ResponseHelper::make(
                TransactionResource::make($transaction->load(['receiver', 'destination', 'addon']))
            );
        }catch(Error $err) {
            return ResponseHelper::error(
                $err->getErrors(),
                $err->getMessage(),
                $err->getCode(),
            );
        }
    }


    public function show(Transaction $transaction) {
        try{
            return ResponseHelper::make(
                TransactionResource::make($transaction->load(['receiver', 'destination', 'addon']))
            );
        }catch(Error $err) {
            return ResponseHelper::error(
                $err->getErrors(),
                $err->getMessage(),
                $err->getCode(),
            );
        }
    }


    public function xenditCallback(Request $request) {
        try{
            $transaction = Transaction::where('code', $request->external_id)->first();
            
            if(!$transaction) throw new Error('Not found', 404);

            $invoices   = collect($transaction->detail['invoices']);
            $status     = Str::lower($request->status);
            $invoices->put($status, $request->all());

            $transaction->update([
                'status' => 2,
                'detail' => ['invoices' => $invoices],
            ]);

            return ResponseHelper::make();
        }catch(Error $err) {
            return ResponseHelper::error(
                $err->getErrors(),
                $err->getMessage(),
                $err->getCode(),
            );
        }
    }
}
