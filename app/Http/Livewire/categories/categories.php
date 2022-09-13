<?php

namespace App\Http\Livewire\Categories;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Categories extends Component
{


    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm ='';
    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $name, $description, $picture;
    public $ids ;


    public function resetInputFields()
    {
        $this->name         = '';
        $this->description  = '';
        $this->picture      = '';
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|unique:categories,name,'.$this->ids,
        ];
    }


    protected function messages ()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'هذا الحقل يجب أن يكون نص',
            'name.unique' => 'أسم القسم مستخدم من قبل',

            'picture.required' => 'هذا الحقل مطلوب',
            'picture.max' => 'يجب ألا يزيد حجم الصورة عن 1024 كيلو بايت.',

           
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function close()
    {
        $this->resetInputFields();

    }

    
    public function store()
    {
        $validatedData = $this->validate();

        Category::create([
            'name'          => $this->name,
            'description'   => $this->description,
            'user_id'       =>  Auth::user()->id,
        ]);
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم أضافة القسم بنجاح',
        ]);
        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function edit(int $id) 
    {
        $category = Category::find($id);
        if ($category) {
            $this->ids          = $category->id;
            $this->name         = $category->name;
            $this->description   = $category->description;

        } else {
            return redirect()->to('/suppliers');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Category::find($this->ids)->update([
            'name'          => $validatedData['name'] ,
            'description'   => $this->description ,

        ]);

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل بيانات القسم بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function editPicture(int $id) 
    {
        $category = Category::find($id);
        if ($category) {
            $this->ids      = $category->id;
            $this->picture  = $category->picture;
        } else {
            return redirect()->to('/categories');
        }
    }

    public function updatePicture()
    {

        $this->validate([
            'picture' => 'image|max:1024', // 1MB Max
        ]);

        $category = Category::find($this->ids);
        
        if ($category->picture) {
            File::delete($category->picture);
        }

        // Storage::disk('public')->delete($category->picture);

        $category->update([
            'picture' =>  'mahrousa/public/uploads/' . $this->picture->store('Categories', 'public'),
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل صورة القسم بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }


    public function status(int $id) 
    {
        $category = Category::find($id);
        if ($category) {
            $this->ids      = $category->id;
            $this->status  = $category->status;
        } else {
            return redirect()->to('/categories');
        }
    }

    public function updateStatus()
    {

        $this->validate([
            'status'   => 'required|numeric',
        ]);

        Category::find($this->ids)->update([
            'status' =>  $this->status,
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل حالة القسم بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function delete($id)
    {
        $this->ids = $id;
    }
    
    public function destroy()
    {
        $category = Category::find($this->ids)->delete();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم حذف القسم بنجاح',
        ]);

        $this->dispatchBrowserEvent('close-modal');

    }





    public function render()
    {

        $searchTerm = '%' . $this->searchTerm .'%';
        $categories = Category::where('name', 'LIKE', $searchTerm)
                            ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);


        return view('livewire.categories.categories',[
            'categories' => $categories,
        ]);
    }
}
