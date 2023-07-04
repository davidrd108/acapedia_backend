<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
      'text' => $this->text,
      'postId' => $this->postId,
      'userId' => $this->userId,
      'post' => $this->when(isset($this->post), function () {
        return new PostResource($this->post);
      }),
      'user' => $this->when(isset($this->user), function () {
        return new UserResource($this->user);
      })
    ];
  }
}
