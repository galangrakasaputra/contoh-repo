<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeddingRsvpController extends Controller
{
    public function store(Request $request, Wedding $wedding): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'attendance' => ['required', 'string', 'in:Hadir,Tidak Hadir'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $rsvp = $wedding->rsvps()->create($validated);

        return response()->json([
            'message' => 'Konfirmasi berhasil disimpan.',
            'rsvp' => $rsvp,
        ], 201);
    }
}
