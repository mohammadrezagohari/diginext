<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\MySQL\UserRepository\InterfaceUserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\User\RegisterRequest;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;
use Exception;

class UserController extends Controller
{
    private InterfaceUserRepository $interfaceUserRepository;

    public function __construct(InterfaceUserRepository $interfaceUserRepository)
    {
        $this->interfaceUserRepository = $interfaceUserRepository;
    }

    public function register(RegisterRequest $request)
    {
        try {
            if (!User::whereUsername($request->username)->count()) {
                $user = $this->interfaceUserRepository->insertData($request->all());
                return response()->json([
                    'message' => 'successfully login',
                    'status' => true,
                    'id' => $user->id,
                    'token' => $user->accesstoken
                ], HTTPResponse::HTTP_OK);
            }
            return response()->json('sorry your username is invalid', HTTPResponse::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'line' => $exception->getLine()], $exception->getCode());
        }
    }


    public function getUser($id)
    {
        try {
            if (@User::find($id)) {
                $user = User::findOrFail($id);
                return response()->json([
                    'message' => 'successfully login',
                    'status' => true,
                    'id' => $user->id,
                    'token' => $user->accesstoken
                ], HTTPResponse::HTTP_OK);
            }
            return response()->json('sorry your user identity is invalid', HTTPResponse::HTTP_BAD_REQUEST);
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage(), 'line' => $exception->getLine()], $exception->getCode());
        }
    }

}
