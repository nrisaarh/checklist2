<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pic;

class PicController extends Controller
{
    public function index()
    {
        $pics = Pic::all(); // Ambil semua data PIC dari database
        return view('pic.index', compact('pics')); // Kirim data ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:pics',
        ]);
        try {
            // Simpan PIC baru ke database
            $pic = Pic::create([
                'name' => $request->name
            ]);
            // Return JSON response untuk AJAX pesan sukses
            return response()->json([
                'success' => true,
                'message' => "PIC '{$pic->name}' berhasil ditambahkan.",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan PIC. Silakan coba lagi.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        logger('ID yang diterima untuk dihapus:', ['id' => $id]);

        $pic = Pic::findOrFail($id);

        if ($pic) {
            $pic->delete();
            return response()->json([
                'success' => true,
                'message' => "PIC '{$pic->name}' berhasil dihapus.",
            ]);
        }
        return response()->json(['success' => false, 'message' => 'PIC tidak ditemukan.']);
    }
}
