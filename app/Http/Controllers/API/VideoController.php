<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\VideoRequest;
use App\Http\Resources\Video\VideoResource;
use App\Repositories\MySQL\VideoRepository\InterfaceVideoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class VideoController extends Controller
{
    private InterfaceVideoRepository $interfaceVideoRepository;

    public function __construct(InterfaceVideoRepository $interfaceVideoRepository)
    {
        $this->interfaceVideoRepository = $interfaceVideoRepository;
    }

    /********************************************
     * Store a newly created resource in storage.
     * @param VideoRequest $request
     * @return JsonResponse
     ********************************************/
    public function store(VideoRequest $request): JsonResponse
    {
        $data = [
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'url' => $request->url
        ];
        $result = $this->interfaceVideoRepository->insertData($data);
        if (@$result)
            return response()->json(['id'=>$result->id,'message' => 'successfully your transaction!'], HTTPResponse::HTTP_OK);
        else
            return response()->json(['message' => 'sorry, your transaction fails!'], HTTPResponse::HTTP_BAD_REQUEST);
    }

    /***********************
     * @param int $id
     * @return VideoResource
     */
    public function show(int $id): VideoResource
    {
        return VideoResource::make($this->interfaceVideoRepository->query()->withIndex()->find($id));
    }
}
