<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends BaseModel
{
  use HasFactory;

  /**
   * Get the category that owns the Post
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function post(): BelongsTo
  {
    return $this->belongsTo(Post::class);
  }

  /**
   * Get the user that owns the Post
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
