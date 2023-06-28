<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BaseModel extends Model
{
  /**
   * Scope a query to only include active users.
   *
   * @param  \Illuminate\Database\Eloquent\Builder  $query
   * @return void
   */
  public function scopeWithRelations($query, $params)
  {
    if (isset($params['relations'])) {
      $query->with($params['relations']);
    }

    return $query;
  }
}
