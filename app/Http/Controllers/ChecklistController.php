<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Pic;

class ChecklistController extends Controller
{
    public function index()
    {
        $checklists = Checklist::all();
        $pics = Pic::all(); // Ambil semua data PIC
        return view('index', compact('checklists', 'pics'));
    }
 // Form tambah checklist
 public function create()
 { 
     return view('create');
 }

 // Simpan checklist baru
 public function store(Request $request)
 {
    $validated = $request->validate([
        'year' => 'required|integer|between:2018,2025',
        'item' => 'required|string',
        'pic' => 'required|exists:pics,name',
        'status' => 'required|string',
        'note' => 'nullable|string',
        'month' => 'required|integer|min:1|max:12',
    ]);
    Checklist::create([
        'year' => $validated['year'],
        'item' => $validated['item'],
        'pic' => $validated['pic'],
        'status' => $validated['status'],
        'note' => $validated['note'],
        'month' => $validated['month'],
    ]);

    return redirect()->back()->with('success', 'Checklist berhasil disimpan!');
}

 // Form edit checklist
 public function edit($id)
 {
     $checklist = Checklist::findOrFail($id);
     return view('edit', compact('checklist'));
 }

 // Update checklist
 public function update(Request $request, $id)
 {
     $checklist = Checklist::findOrFail($id);
     $checklist->update($request->all());
     return redirect()->route('index')->with('success', 'Checklist berhasil diperbarui!');
 }

 // Hapus checklist
 public function destroy($id)
 {
     $checklist = Checklist::findOrFail($id);
     $checklist->delete();
     return redirect()->route('index')->with('success', 'Checklist berhasil dihapus!');
 }
}