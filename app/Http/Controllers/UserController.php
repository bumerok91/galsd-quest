<?php

namespace App\Http\Controllers;

use App\Events\TransactionEvent;
use App\Http\Models\User;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse|Response
     * @throws ValidationException
     */
    public function transaction(Request $request)
    {
        $this->validate($request, [
            'from' => 'required|int|exists:user,id',
            'to' => 'required|int|exists:user,id',
            'amount' => 'required|numeric|gt:0'
        ]);

        /** @var User $fromUser */
        $fromUser = User::query()->findOrFail($request->from);

        if($request->amount > $fromUser->balance) {
            $error = 'Not enough money on ' . $fromUser->name . '`s balance!';

            return new JsonResponse($error, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var User $toUser */
        $toUser = User::query()->findOrFail($request->to);

        $event = new TransactionEvent($fromUser, $toUser, round($request->amount, 2));
        event($event);

        return new JsonResponse('Transaction has been sent for processing!');
    }
}