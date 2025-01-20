<?php

namespace App\Http\Controllers;

use App\Services\FacebookPostService;
use Illuminate\Http\Request;

class FacebookPostController extends Controller
{
    protected $facebookPostService;

    public function __construct(FacebookPostService $facebookPostService)
    {
        $this->facebookPostService = $facebookPostService;
    }

    public function post(Request $request)
    {
        $message = $request->input('message');

        if (!$message) {
            return response()->json(['error' => 'Message is required'], 400);
        }

        $result = $this->facebookPostService->postToFacebook($message);

        if ($result['success']) {
            return response()->json(['message' => 'Post created successfully', 'post_id' => $result['post_id']], 200);
        } else {
            return response()->json(['error' => $result['error']], 500);
        }
    }
}
