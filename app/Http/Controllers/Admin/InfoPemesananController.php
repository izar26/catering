<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoPemesanan;
use Illuminate\Http\Request;

class InfoPemesananController extends Controller
{
    public function edit()
    {
        // Ambil baris pertama, atau buat baru jika tabel masih kosong.
        $info = InfoPemesanan::firstOrCreate([]);
        return view('admin.info_pemesanan.edit', compact('info'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'info_pengiriman' => 'nullable|string',
            'info_pembayaran' => 'nullable|string',
            'info_pembatalan' => 'nullable|string',
            'info_harga' => 'nullable|string',
        ]);

        // Cari baris pertama, atau buat baru, lalu update dengan data baru.
        $info = InfoPemesanan::firstOrCreate([]);
        $info->update($data);

        return redirect()->back()->with('success', 'Info Pemesanan berhasil diperbarui.');
    }
}