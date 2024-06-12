<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index($query)
    {

        /* dd($query); */
        // search for users that includes the query on their username, name. Also retreive their profile!
        // parcial conicidence, no exact coincidence
        $users = User::where('name', 'like', '%' . $query . '%')
        ->where('id', '!=', auth()->user()->id)
        ->with('profile')
        ->get();

        // first parameter 'name' -> refers to the table column
        // second parameter 'like' -> refers to an SQL operator, like is used for parcial coincidence
        // third parameter '% $query % -> it is basically the string that is going to look for on the table records

        /* dd($users[0]->profile); */
        return response()->json(['users' => $users]);
    }
}
