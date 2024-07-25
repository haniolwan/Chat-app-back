<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    use ResponseTrait;

    public function acceptRequest(User $user)
    {
        $userId = Auth::user()->id;
        Friend::where('user_id', $userId)
            ->where('friend_id', $user->id)->update(['accepted' => true]);
        return $this->success_response(
            ["Friend Request Accepted"],
            [],
            200
        );
    }

    public function removeRequest(User $user)
    {
        /** @var User $user */
        $userId = Auth::id();
        Friend::where('user_id', $userId)->where('friend_id', $user->id)->delete();
        return $this->success_response(
            ["Friend Request Removed"],
            [],
            200
        );
    }
}
