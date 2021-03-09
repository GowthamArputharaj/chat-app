<?php

use App\Broadcasting\messaging;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Psy\TabCompletion\AutoCompleter;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('the-private-channel', function () {
    return true;
});

Broadcast::channel('the-private-channel-user', function () {
    return true;
});

Broadcast::channel('the-presence-channel-user', function() {
    return auth()->user();
});

Broadcast::channel('the-presence-channel.{type}', function ($type) {
    // return User::find(5);
    // return true;
    // return true;

    // return auth()->user();

    if($type == 'user') {
        return User::where('id', auth()->user()->id)->with('messages')->get()[0];
    } 

    if($type == 'message') {
        return Messages::find(1);
    }
    $asdf = User::where('id', auth()->user()->id)->with('messages')->get()[0];
    $asdf['latestMessage'] = (new User)->getLatestMessageAttribute();
    return $asdf;
});

Broadcast::channel('messaging', function() {
    return Messages::find(1);
    // return true;
});

// Broadcast::channel('messaging', messaging::class);


