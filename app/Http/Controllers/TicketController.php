<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TicketController extends Controller
{
                //
                public function create()
                {
                $users = User::take(10)->get();
                



                // Pass permissions to the view
                return view('ticket.create',compact('users'));
                }
                    public function upload(Request $request)
                    {
                    $request->validate([
                    'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                    ]);

                    if ($request->hasFile('photo')) {
                    $path = $request->file('photo')->store('uploads/tickets', 'public');
                    return response()->json(['path' => $path], 200);
                    }

                    return response()->json(['error' => 'File upload failed'], 400);
                    }


}
