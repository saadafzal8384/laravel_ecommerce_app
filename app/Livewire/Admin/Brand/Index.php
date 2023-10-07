<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status;

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
        ];
    }

    public function resetInputFields(): void
    {
        $this->name = '';
        $this->slug = '';
        $this->status = '';
    }

    public function storeBrand(): void
    {
        $this->validate();
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status === true ? '1' : '0',
        ]);
        session()->flash('success', 'Brand Created Successfully.');
        $this->dispatch('close-modal');
        $this->resetInputFields();
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'ASC')->paginate(5);
        return view('livewire.admin.brand.index', ['brands' => $brands])->extends('layouts.admin')->section('content');
    }
}
