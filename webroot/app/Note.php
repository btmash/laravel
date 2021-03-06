<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title',
      'note',
      'user_id',
  ];

  public function author() {
    return $this->belongsTo('App\User', 'user_id');
  }
}
