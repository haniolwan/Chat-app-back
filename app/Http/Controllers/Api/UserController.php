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
        return $user->friendsTo()->get();
    }

    public function pendingRequestsFrom()
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->friendsFrom()->get();
    }

  
    public function friends()
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->friends;
    }
}
