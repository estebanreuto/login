<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UiPreferenceController extends Controller
{
    public function setViewMode(Request $request): JsonResponse
    {
        $request->validate([
            'view_mode' => 'required|in:table,cards',
        ]);

        $user = auth()->user();
        $user->view_mode = $request->view_mode;
        $user->save();

        return response()->json(['status' => 'success']);
    }
}
