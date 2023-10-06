<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class Index extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $category_id;

    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }

    public function destroyCategory()
    {
        $category = Category::find($this->category_id);
        if (File::exists('uploads/category/' . $category->image)) {
            File::delete('uploads/category/' . $category->image);
        }
        $category->delete();
        session()->flash('success', 'Category deleted successfully');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(5);
        return view('livewire.admin.category.index', ['categories' => $categories]);
    }

}
