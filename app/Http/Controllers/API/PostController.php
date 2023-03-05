<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Posts\PostResource;
use App\Repositories\MySQL\PostRepository\InterfacePostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class PostController extends Controller
{
    private InterfacePostRepository $interfacePostRepository;

    public function __construct(InterfacePostRepository $interfacePostRepository)
    {
        $this->interfacePostRepository = $interfacePostRepository;
    }

    /********************************************
     * Store a newly created resource in storage.
     * @param PostRequest $request
     * @return JsonResponse
     ********************************************/
    public function store(PostRequest $request): JsonResponse
    {
        $data = [
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'content' => $request->content
        ];
        $result = $this->interfacePostRepository->insertData($data);
        if (@$result)
            return response()->json(['id'=>$result->id,'message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        else
            return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);
    }

    /***********************
     * @param int $id
     * @return PostResource
     */
    public function show(int $id): PostResource
    {
        return PostResource::make($this->interfacePostRepository->query()->withIndex()->find($id));
    }
}
