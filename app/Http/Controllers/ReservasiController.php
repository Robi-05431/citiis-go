<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservasiController extends Controller
{
    public function index(): View
    {
        return view('pages.reservasi');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'tipe'          => 'required|in:penginapan,camping,peralatan',
            'item'          => 'required|string|max:100',
            'tanggal_masuk' => 'required|date|after_or_equal:today',
            'tanggal_keluar' => 'nullable|date|after:tanggal_masuk',
            'jumlah'        => 'required|integer|min:1',
            'catatan'       => 'nullable|string|max:500',
        ]);

        // TODO: simpan ke database, kirim notifikasi, dll.

        return redirect()->route('reservasi')->with('success', true);
    }
}
