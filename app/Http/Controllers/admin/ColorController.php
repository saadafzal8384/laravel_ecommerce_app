<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Colors;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ColorController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $colors = Colors::all();
        return view('admin.colors.index',['colors' => $colors]);
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
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
        return redirect('admin/colors')->back()->with('error', 'Invalid Color Data');
    }

    public function edit(Colors $color): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.colors.edit', compact('color'));
    }

    public function update(ColorFormRequest $request, Colors $color)
    {
        $validatedData = $request->validated();
        if ($validatedData) {
            $color = Colors::findOrFail($color->id);
            $color->name = $validatedData['name'];
            $color->code = $validatedData['code'];
            $color->status = $request->has('status');
            if($color->save())
            {
                return redirect('admin/colors')->with('success', 'Color updated successfully');
            }
            else
            {
                return redirect('admin/colors')->back()->with('error', 'Database error');
            }
        }
        return redirect('admin/colors')->back()->with('error', 'Invalid Color Data');
    }

    public function destroy(Colors $color)
    {
        $color = Colors::findOrFail($color->id);
        if($color->delete())
        {
            return redirect('admin/colors')->with('success', 'Color deleted successfully');
        }
        else
        {
            return redirect('admin/colors')->back()->with('error', 'Database error');
        }
    }
}
