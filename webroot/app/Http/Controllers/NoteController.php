<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
  //
  public function list()
  {
    $user = Auth::user();
    $notes = [];
    foreach ($user->notes as $note) {
      $notes[] = [
        'id' => $note->id,
        'title' => $note->title,
        'created' => $note->created_at,
        'updated' => $note->updated_at,
      ];
    }
    return $notes;
  }

  public function show($id)
  {
    $user = Auth::user();
    $note = $user->notes()->where('id', $id)->firstOrFail();
    return [
      'id' => $note->id,
      'title' => $note->title,
      'created' => $note->created_at,
      'updated' => $note->updated_at,
    ];
  }

  public function create(Request $request)
  {
    $user = Auth::user();
    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'note' => ['required', 'string', 'max:1000'],
    ]);

    $note = new Note([
      'title' => $request->get('title'),
      'note' => $request->get('note'),
    ]);
    $user->notes()->save($note);
    return $note;
  }

  public function update(int $id, Request $request)
  {
    $user = Auth::user();
    $note = $user->notes()->where('id', $id)->firstOrFail();

    $request->validate([
      'title' => ['required', 'string', 'max:255'],
      'note' => ['required', 'string', 'max:1000'],
    ]);

    $note->title = $request->get('title');
    $note->note = $request->get('note');
    return $note->save();
  }

  public function delete($id)
  {
    $user = Auth::user();
    $user->notes()->where('id', $id)->firstOrFail();
    return Note::destroy($id);
  }
}
