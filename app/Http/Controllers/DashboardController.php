<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah produk
        $productCount = Product::count();

        // Kirim data ke view
        return view('dashboard', compact('productCount'));
    }
}
