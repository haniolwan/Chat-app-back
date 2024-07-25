<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResponseTrait;
    public function pendingRequestsTo()
    {
        /** @var User $user */
        $user = Auth::user();
        $data = $user->friendsTo()->get();
        return $this->success_response(
            ["Send pending requests"],
            [$data],
            200
        );
    }

    public function pendingRequestsFrom()
    {
        /** @var User $user */
        $user = Auth::user();
        $data =  $user->friendsFrom()->get();
        return $this->success_response(
            ["Recieved pending requests"],
            [$data],
            200
        );
    }


    public function friends()
    {
        /** @var User $user */
        $user = Auth::user();
        $data = $user->friends;
        return $this->success_response(
            ["All friends"],
            [$data],
            200
        );
    }
}
