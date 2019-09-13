<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{

  /**
   * Index function to show list of notes.
   * @return array
   *   JSON response of note items.
   */
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

  /**
   * Index function to show list of notes.
   *
   * @param int $id.
   *   The note ID.
   *
   * @return array
   *   JSON response of note item.
   */
  public function show(int $id)
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

  /**
   * Stores new note.
   *
   * @param Request $request
   *
   * @return Note
   */
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

  /**
   * Updates existing note.
   *
   * @param int $id
   * @param Request $request
   *
   * @return mixed
   */
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
    $note->save();
    return $note;
  }

  /**
   * Deletes existing note.
   *
   * @param int $id
   *
   * @return int
   */
  public function delete(int $id)
  {
    $user = Auth::user();
    $user->notes()->where('id', $id)->firstOrFail();
    return Note::destroy($id);
  }
}
