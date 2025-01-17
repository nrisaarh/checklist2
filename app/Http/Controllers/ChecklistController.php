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
        'year' => 'required|numeric',
        'item' => 'required|string',
        'pic' => 'nullable|string',
        'new_pic' => 'nullable|string',
        'status' => 'required|string',
        'note' => 'nullable|string',
        'month' => 'required|integer|min:1|max:12',
    ]);
     // Tambahkan PIC baru jika diisi
     if ($request->filled('new_pic')) {
        $newPic = Pic::create(['name' => $request->new_pic]);
        $request->merge(['pic' => $newPic->name]); // Gunakan PIC baru
    }
    
    // Simpan checklist
    Checklist::create([
        'year' => $validated['year'],
        'item' => $validated['item'],
        'pic' => $validated['pic'],
        'status' => $validated['status'],
        'note' => $validated['note'],
        'month' => $validated['month'],
    ]);

    return redirect()->route('checklists.index')->with('success', 'Checklist berhasil ditambahkan.');
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
      // Ambil bulan yang dicentang dari form
    $completedMonths = array_keys($request->input('month_check', []));

    // Ambil bulan yang dicentang dari form
    $completedMonths = array_keys($request->input('month_check', []));

    // Simpan bulan yang selesai ke database
    $checklist->completed_months = $completedMonths;
    $checklist->save();

    return redirect()->back()->with('success', 'Checklist berhasil diperbarui.');
}
 public function destroy($id)
 {
     $checklist = Checklist::findOrFail($id);
     $checklist->delete();
     return redirect()->route('index')->with('success', 'Checklist berhasil dihapus!');
 }
}