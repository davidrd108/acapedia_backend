<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Mappers\PostMapper;
use App\Models\Post;
use Business\UseCases\PostInteractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Response;
use InvalidArgumentException;

class PostController extends Controller
{
  private PostInteractor $postInteractor;

  public function __construct(PostInteractor $postInteractor)
  {
    $this->postInteractor = $postInteractor;
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    try {
      $posts = $this->postInteractor->listPosts(["search" => $request->input('search'), "category" => $request->input('category')]);

      return PostResource::collection($posts);
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
  public function store(StorePostRequest $request)
  {
    try {
      $post = $this->postInteractor->createPost(PostMapper::mapCreateRequestToPostEntity($request));

      return (new PostResource($post))
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
   * Display the specified resource.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show($postId)
  {
    try {
      $post = $this->postInteractor->showPost($postId);

      return new PostResource($post);
    } catch (\Throwable $th) {
      return response()
        ->json(['message' => $th->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Client\Request  $request
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    //
  }
}
