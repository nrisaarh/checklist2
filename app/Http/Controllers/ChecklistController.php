<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Models\Pic;
use App\Models\Year;

class ChecklistController extends Controller
{
    public function index()
    {
        $years = Year::all(); // Mengambil semua tahun dari model Year
        $checklists = Checklist::all();
        $pics = Pic::all(); // Ambil semua data PIC
        return view('checklists.index', compact('years','checklists', 'pics'));
    }


 // Form tambah checklist
 public function create()
 { 
     return view('create');
 }

 // Simpan checklist baru
 public function store(Request $request)
 {
    $validatedData = $request->validate([
        'year' => 'required|numeric',
        'item' => 'required|string',
        'pic' => 'required|string',
        'new_pic' => 'nullable|string',
        'status' => 'nullable|string',
        'note' => 'nullable|string',
        'month' => 'required|integer|min:1|max:12',
    ]);
    
     // Tambahkan PIC baru jika diisi
     if ($request->filled('new_pic')) {
        $newPic = Pic::create(['name' => $request->new_pic]);
        $request->merge(['pic' => $newPic->name]); // Gunakan PIC baru
    }
    
    // Simpan checklist
    Checklist::create($validatedData);

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