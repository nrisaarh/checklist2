<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;

class YearController extends Controller
{
    public function addYear(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'new_year' => 'required|integer|min:2025|unique:years,year',
            ]);

            // Simpan tahun ke database
            $year = new Year();
            $year->year = $request->new_year;
            $year->save();

            // Kembalikan response ke front-end
            return response()->json([
                'status' => 'success',
                'message' => 'Tahun berhasil ditambahkan!',
                'data' => $year,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani error validasi
            return response()->json([
                'status' => 'error',
                'message' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Tangani error umum
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan. Silakan coba lagi.',
            ], 500);
        }
    }
}