<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::paginate(15);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
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

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function show(Member $member)
    {
        $member->load('borrowings.book');
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
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

        return redirect()->route('members.index')->with('success', 'Anggota berhasil diupdate');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Anggota berhasil dihapus');
    }
}
