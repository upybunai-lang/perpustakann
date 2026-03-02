<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::paginate(15);
        return response()->json($members);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_code' => 'required|unique:members,member_code|max:50',
            'name' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $member = Member::create($validated);

        return response()->json([
            'message' => 'Anggota berhasil ditambahkan',
            'data' => $member,
        ], 201);
    }

    public function show(Member $member)
    {
        return response()->json($member->load('borrowings.book'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'member_code' => 'required|max:50|unique:members,member_code,' . $member->id,
            'name' => 'required|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|max:20',
            'address' => 'nullable',
            'join_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($validated);

        return response()->json([
            'message' => 'Anggota berhasil diupdate',
            'data' => $member,
        ]);
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json([
            'message' => 'Anggota berhasil dihapus',
        ]);
    }

    public function search($keyword)
    {
        $members = Member::where('name', 'like', "%{$keyword}%")
            ->orWhere('member_code', 'like', "%{$keyword}%")
            ->orWhere('email', 'like', "%{$keyword}%")
            ->paginate(15);

        return response()->json($members);
    }

    public function updateStatus(Request $request, Member $member)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($validated);

        return response()->json([
            'message' => 'Status anggota berhasil diupdate',
            'data' => $member,
        ]);
    }
}
