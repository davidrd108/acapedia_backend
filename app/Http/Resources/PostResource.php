<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Comment;

class PostResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'createdAt' => $this->createdAt,
      'updatedAt' => $this->updatedAt,
      'title' => $this->title,
      'description' => $this->description,
      'categoryId' => $this->categoryId,
      'userId' => $this->userId,
      'comment_count' => $this->whenCounted('comments'),
      'category' => $this->when(isset($this->category), function () {
        return new CategoryResource($this->category);
      }),
      'user' => $this->when(isset($this->user), function () {
        return new UserResource($this->user);
      }),
      'comments' => CommentResource::collection(Comment::where('post_id', $this->id)->orderBy('created_at', 'desc')->take(5)->get())
    ];
  }
}
