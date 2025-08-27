<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;

Artisan::command('users-awaiting', function () {
    $users = User::where('status', 0)->get();

    if ($users->isEmpty()) {
        $this->comment('No users awaiting registration.');
        return;
    }

    foreach ($users as $user) {
        $this->line("ID: {$user->id} | Name: {$user->name} | Email: {$user->email}");
    }

    $this->line('Count: ' . $users->count());
})->purpose('List users awaiting register status');


Artisan::command('users-approve {email}', function (string $email) {

    $user = User::where('email', $email)->first();

    if ($user == null) {
        $this->comment('No user found.');
        return;
    }

    $user->status = 1;

    $user->save();

    $this->comment('User approved!');
    return;

})->purpose('Approve user');


Artisan::command('users-denied {email}', function (string $email) {

    $user = User::where('email', $email)->first();

    if ($user == null) {
        $this->comment('No user found.');
        return;
    }

    $user->status = 2;

    $user->save();

    $this->comment('User denied!');
    return;

})->purpose('Denied user');

