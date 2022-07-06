<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AntarBahan;

class AntarBahanController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.antarbahan.index');
    }

    public function all(Request $request)
    {
        $from=$request->input('tgl-dari')?$request->input('tgl-dari'):date('Y-m-d');
        $to=$request->input('tgl-sampai')?$request->input('tgl-sampai'):date('Y-m-d');

        return datatables()->eloquent(
            AntarBahan::with(['user','lab'])
            // ->whereBetween('created_at', array($from, $to))
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
        )->toJson();
    }
}