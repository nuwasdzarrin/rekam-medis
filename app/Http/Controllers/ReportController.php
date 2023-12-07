<?php

namespace App\Http\Controllers;

use App\Models\Rekam;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $rekams = Rekam::query()->get();
        return response()->view('report.index', ['rekams'=>$rekams]);

    }
}
