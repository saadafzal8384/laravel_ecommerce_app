<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Colors;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.colors.index');
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        if ($validatedData) {
            $color = new Colors();
            $color->name = $validatedData['name'];
            $color->code = $validatedData['code'];
            $color->status = $request->status === true ? '1' : '0';
            if($color->save())
            {
                return redirect('admin/colors')->with('success', 'Color added successfully');
            }
            else
            {
                return redirect('admin/colors')->back()->with('error', 'Database error');
            }
        }
    }
}
