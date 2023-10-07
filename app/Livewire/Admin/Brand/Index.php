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

    public $name, $slug, $status, $brand_id;

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',
        ];
    }

    public function render()
    {
        $brands = Brand::orderBy('id', 'ASC')->paginate(5);
        return view('livewire.admin.brand.index', ['brands' => $brands])->extends('layouts.admin')->section('content');
    }

    public function resetInputFields(): void
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
    }

    public function openModal(): void
    {
        $this->resetInputFields();
    }

    public function closeModal(): void
    {
        $this->resetInputFields();
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

    public function editBrand(int $brand_id): void
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->dispatch('open-modal');
    }

    public function updateBrand(): void
    {
        $this->validate();
        $brand = Brand::findOrFail($this->brand_id);
        $brand->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status === true ? '1' : '0',
        ]);
        session()->flash('success', 'Brand Updated Successfully.');
        $this->dispatch('close-modal');
        $this->resetInputFields();
    }

    public function deleteBrand(int $brand_id): void
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand(): void
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('success', 'Brand Deleted Successfully.');
        $this->dispatch('close-modal');
        $this->resetInputFields();
    }
}
