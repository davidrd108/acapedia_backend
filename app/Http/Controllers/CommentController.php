<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Mappers\CommentMapper;
use App\Models\Comment;
use Business\UseCases\CommentInteractor;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;
use InvalidArgumentException;

class CommentController extends Controller
{
  private CommentInteractor $commentInteractor;

  public function __construct(CommentInteractor $commentInteractor)
  {
    $this->commentInteractor = $commentInteractor;
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StorePostRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCommentRequest $request)
  {
    try {
      $comment = $this->commentInteractor->addCommentToPost(CommentMapper::mapCreateRequestToCommentEntity($request));

      return (new CommentResource($comment))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    } catch (InvalidArgumentException $e) {
      return response()
        ->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
    } catch (\Throwable $th) {
      return response()
        ->json(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StorePostRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function listByPost($postId)
  {
    try {
      $comments = $this->commentInteractor->listComments($postId);
      return CommentResource::collection($comments);
    } catch (InvalidArgumentException $e) {
      return response()
        ->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
    } catch (\Throwable $th) {
      return response()
        ->json(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Comment $commentId)
  {
    try {
      return $this->commentInteractor->deleteComment($commentId);
    } catch (\Throwable $th) {
      return response()
        ->json(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
