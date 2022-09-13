<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;
use App\Models\Supplier;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Products extends Component
{

    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm ='';
    public $paginateCount = 10;
    public $selectCategory = 0;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $ids, $barcode, $name, $description, $cost_price, $selling_price, $discount, $quantity, $picture, $category_id, $supplier_id, $status;

    public $nameCategory, $descriptionCategory, $company_name, $nameSupplier;

    public function resetInputFields()
    {
        $this->barcode          = '';
        $this->name             = '';
        $this->description      = '';
        $this->cost_price       = '';
        $this->selling_price    = '';
        $this->discount         = '';
        $this->quantity         = '';
        $this->picture          = '';
        $this->category_id      = '';
        $this->supplier_id      = '';
        $this->status           = '';
    }

    protected function rules()
    {
        return [
            'barcode'       => 'required|string|unique:products,barcode,'.$this->ids,
            'name'          => 'required|string|unique:products,name,'.$this->ids,
            'cost_price'    => 'required|numeric',
            'selling_price' => 'required|numeric',
            'discount'      => 'required|numeric',
            'quantity'      => 'required|numeric',
            'category_id'   => 'required|numeric',
            'supplier_id'   => 'required|numeric',

        ];
    }


    protected function messages ()
    {
        return [
            'barcode.required'  => 'هذا الحقل مطلوب',
            'barcode.string'    => ' هذا الحقل يجب أن يكون نص وأرقام',
            'barcode.unique'    => 'كود الباركود مستخدم من قبل',

            'name.required' => 'هذا الحقل مطلوب',
            'name.string'   => 'هذا الحقل يجب أن يكون نص وأرقام',
            'name.unique'   => 'أسم المنتج مستخدم من قبل',

            'cost_price.required'   => 'هذا الحقل مطلوب',
            'cost_price.numeric'    => 'هذا الحقل يجب أن يكون أرقام',

            'selling_price.required'    => 'هذا الحقل مطلوب',
            'selling_price.numeric'     => 'هذا الحقل يجب أن يكون أرقام',

            'discount.required' => 'هذا الحقل مطلوب',
            'discount.numeric'  => 'هذا الحقل يجب أن يكون أرقام',

            'quantity.required' => 'هذا الحقل مطلوب',
            'quantity.numeric'  => 'هذا الحقل يجب أن يكون أرقام',

            'nameCategory.required'  => 'هذا الحقل مطلوب',
            'category_id.required'  => 'هذا الحقل مطلوب',
            'category_id.numeric'   => 'هذا الحقل يجب أن يكون أرقام',

            'nameSupplier.required'  => 'هذا الحقل مطلوب',
            'supplier_id.required'  => 'هذا الحقل مطلوب',
            'supplier_id.numeric'   => 'هذا الحقل يجب أن يكون أرقام',

            'picture.required'  => 'هذا الحقل مطلوب',
            'picture.max'       => 'يجب ألا يزيد حجم الصورة عن 1024 كيلو بايت.',

           
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
        $this->validate();

        Product::create([
            'barcode'       => $this->barcode,
            'name'          => $this->name,
            'description'   => $this->description,
            'cost_price'    => $this->cost_price,
            'selling_price' => $this->selling_price,
            'discount'      => $this->discount,
            'quantity'      => $this->quantity,
            'category_id'   => $this->category_id,
            'supplier_id'   => $this->supplier_id,
            'user_id'       =>  Auth::user()->id,
        ]);

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم أضافة المنتج بنجاح',
        ]);
        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function edit(int $id) 
    {
        $product = Product::find($id);
        if ($product) {
            $this->ids          = $product->id;
            $this->barcode      = $product->barcode;
            $this->name         = $product->name;
            $this->description  = $product->description;
            $this->cost_price   = $product->cost_price;
            $this->selling_price= $product->selling_price;
            $this->discount     = $product->discount;
            $this->quantity     = $product->quantity;
            $this->category_id  = $product->category_id;
            $this->supplier_id  = $product->supplier_id;
        } else {
            return redirect()->to('/suppliers');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Product::find($this->ids)->update([
            'barcode'       => $validatedData['barcode'] ,
            'name'          => $validatedData['name'] ,
            'description'   => $this->description ,
            'cost_price'    => $validatedData['cost_price'] ,
            'selling_price' => $validatedData['selling_price'] ,
            'discount'      => $validatedData['discount'] ,
            'quantity'      => $validatedData['quantity'] ,
            'category_id'   => $validatedData['category_id'] ,
            'supplier_id'   => $validatedData['supplier_id'] ,
            'user_id'       =>  Auth::user()->id,

        ]);

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل بيانات المنتج بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function editPicture(int $id) 
    {
        $product = Product::find($id);
        if ($product) {
            $this->ids      = $product->id;
            $this->picture  = $product->picture;
        } else {
            return redirect()->to('/products');
        }
    }

    public function updatePicture()
    {

        $this->validate([
            'picture' => 'image|max:1024', // 1MB Max
        ]);

        $product = Product::find($this->ids);
        if ($product->picture) {
            File::delete($product->picture);
        }
        $product->update([
            'picture' =>  'mahrousa/public/uploads/' . $this->picture->store('Products', 'public'),
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل صورة المنتج بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }


    public function status(int $id) 
    {
        $product = Product::find($id);
        if ($product) {
            $this->ids      = $product->id;
            $this->status  = $product->status;
        } else {
            return redirect()->to('/products');
        }
    }

    public function updateStatus()
    {

        $this->validate([
            'status'   => 'required|numeric',
        ]);

        Product::find($this->ids)->update([
            'status' =>  $this->status,
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل حالة المنتج بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function barcode(int $id) 
    {
        $product = Product::find($id);
        if ($product) {
            $this->ids      = $product->id;
            $this->barcode  = $product->barcode;
            $this->name  = $product->name;
            $this->selling_price  = $product->selling_price;
        } else {
            return redirect()->to('/products');
        }
    }





    public function delete($id)
    {
        $this->ids = $id;
    }
    
    public function destroy()
    {
        $product = Product::find($this->ids)->delete();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم حذف المنتج بنجاح',
        ]);

        $this->dispatchBrowserEvent('close-modal');

    }




    public function storeCategory()
    {
        $validatedData = $this->validate([
            'nameCategory' => 'required',
        ]);

        Category::create([
            'name' => $this->nameCategory,
            'description' => $this->descriptionCategory,
            'user_id' =>  Auth::user()->id,
        ]);

        $this->nameCategory = '';
        $this->descriptionCategory = '';
        
        $this->dispatchBrowserEvent('close-sub-modal');

    }

    public function storeSupplier()
    {
        $validatedData = $this->validate([
            'nameSupplier' => 'required',
        ]);

        Supplier::create([
            'name' => $this->nameSupplier,
            'user_id' =>  Auth::user()->id,
        ]);

        $this->company_name = '';
        $this->nameSupplier = '';
        
        $this->dispatchBrowserEvent('close-sub-modal');

    }
    public function render()
    {
        $setting = Setting::first();
        $categories = Category::orderBy('id', 'DESC')->get();
        $suppliers = Supplier::orderBy('id', 'DESC')->get();

        if ($this->searchTerm == '') {
            $products = Product::where('category_id', $this->selectCategory == 0 ? '!=' : '=' , $this->selectCategory == 0 ? '0' : $this->selectCategory)
                                ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);
        } else {
            $searchTerm = '%' . $this->searchTerm .'%';
            $products = Product::where('category_id', $this->selectCategory == 0 ? '!=' : '=' , $this->selectCategory == 0 ? '0' : $this->selectCategory)
                                ->where('barcode', 'LIKE', $searchTerm)
                                ->orWhere('name', 'LIKE', $searchTerm)
                                ->orWhere('selling_price', 'LIKE', $searchTerm)
                                ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);
        }


        return view('livewire.products.products',[
            'setting' => $setting,
            'products' => $products,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }
}
