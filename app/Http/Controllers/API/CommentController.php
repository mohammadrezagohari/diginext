<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Models\Video;
use App\Repositories\MySQL\CommentRepository\InterfaceCommentRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class CommentController extends Controller
{

    private InterfaceCommentRepository $interfaceCommentRepository;

    public function __construct(InterfaceCommentRepository $interfaceCommentRepository)
    {
        $this->interfaceCommentRepository = $interfaceCommentRepository;
    }

    /********************************************
     * Store a newly created resource in storage.
     * @param $id
     * @param CommentRequest $request
     * @return JsonResponse
     ********************************************/
    public function storePostComment($id, CommentRequest $request): JsonResponse
    {
        $post = Post::findOrFail($id);
        $data = [
            'text' => $request->text,
            'user_id' => Auth::user()->id,
        ];
        $result = $this->interfaceCommentRepository->storePostComment($post, $data);
        if (@$result)
            return response()->json(['id' => $result->id, 'message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        else
            return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);
    }

    /********************************************
     * Store a newly created resource in storage.
     * @param $id
     * @param CommentRequest $request
     * @return JsonResponse
     ********************************************/
    public function storeVideoComment($id, CommentRequest $request): JsonResponse
    {
        $video = Video::findOrFail($id);
        $data = [
            'text' => $request->text,
            'user_id' => Auth::user()->id,
        ];
        $result = $this->interfaceCommentRepository->storeVideoComment($video, $data);
        if (@$result)
            return response()->json(['id' => $result->id, 'message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        else
            return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);
    }
}
