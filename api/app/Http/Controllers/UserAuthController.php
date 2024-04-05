<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */

    public function index() : JsonResponse 
    {
        return response()->json([
            'data' => $this->userRepository->getAllUsers()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        try{
            
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $newUser = [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->password,
            ];

            if($this->userRepository->createUser($newUser)){
                return response()->json([
                    'message' => 'User has been created',
                ]);    
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userRecord = $this->userRepository->getUserById($id);
        
        if(!$userRecord)
        {
            return response()->json(['error' => 'User not found'],404);
        }

        return response()->json([
            'data' => $userRecord
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $userRecord = $this->userRepository->getUserById($id);

        if(!$userRecord)
        {
            return response()->json(['status' => false, 'message' => 'Record not found'],404);
        }

        $userData = $request->all();

        if($this->userRepository->updateUserById($userData, $id))
        {
            return response()->json(['status' => true, 'message' => 'User has been updated'],200);
        }else
        {
            return response()->json(['status' => false, 'message' => 'Failed to update record'],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userRecord = $this->userRepository->getUserById($id);

        if(!$userRecord){
            return response()->json(['status' => false, 'message' => 'User not found'],404);
        }

        $this->userRepository->userDeleteById($id);

        return response()->json(['status' => true, 'message' => 'User deleted successfully'],200);
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
          "message"=>"logged out"
        ]);
    }


}
