<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
  //
  public function list()
  {
    $user = Auth::user();
    return $user->notes()->trainings;
  }

  public function create(Request $request)
  {
    $user = Auth::user();
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'max:1000'],
    ]);

    $note = new Note([
      'title' => $request->get('title'),
      'note' => $request->get('note'),
    ]);
    $user->notes()->save($note);

  }

}
