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

  public function delete($id) {
    $user = Auth::user();
    $note = $this->findNote($id, $user);
    return Note::destroy($id);

  }

  private function findNote($id, $user) {
    return Note::where('id', $id)->where('user_id', $user->id);
  }
}
