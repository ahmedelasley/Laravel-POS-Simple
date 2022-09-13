<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Category;
use App\Models\Supplier;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'decrease' => '$refresh',
        'increase' => '$refresh',
        'deleteProduct' => '$refresh',
        'barcode' => '$refresh',
        'cancelCart' => '$refresh',
        'pay' => '$refresh',
        'addProduct' => '$refresh',
        'addCategory' =>'$refresh',
        'addSupplier' =>'$refresh',

        
    ];
    public $barcode;
    public $name;
    public $description;
    public $cost_price;
    public $selling_price;
    public $quantity;
    public $picture;
    public $category;
    public $supplier;

    public $searchTerm ='';
    public $paginateCount = 18;
    public $selectCategory = 0;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $nameCategory;
    public $descriptionCategory;

    public $company_name;
    public $nameSupplier;

    public function resetInputFields()
    {
        $this->barcode      = '';
        $this->name         = '';
        $this->description  = '';
        $this->cost_price   = '';
        $this->selling_price= '';
        $this->quantity     = '';
        $this->picture     = '';
        $this->category     = '';
        $this->supplier     = '';
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
            'category.required'  => 'هذا الحقل مطلوب',
            'category.numeric'   => 'هذا الحقل يجب أن يكون أرقام',

            'nameSupplier.required'  => 'هذا الحقل مطلوب',
            'supplier.required'  => 'هذا الحقل مطلوب',
            'supplier.numeric'   => 'هذا الحقل يجب أن يكون أرقام',

            'picture.required'  => 'هذا الحقل مطلوب',
            'picture.max'       => 'يجب ألا يزيد حجم الصورة عن 1024 كيلو بايت.',

           
        ];
    }
    public function storeProduct()
    {
        $validatedData = $this->validate([
            'barcode' => 'required|unique:products',
            'name' => 'required',
            'cost_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'supplier' => 'required',
            // 'picture' => 'required',

        ]);

        Product::create([
            'barcode' => $this->barcode,
            'name' => $this->name,
            'description' => $this->description,
            'cost_price' => $this->cost_price,
            'selling_price' => $this->selling_price,
            'quantity' => $this->quantity,
            'picture' => $this->picture ==NULL ? NULL : 'mahrousa/public/uploads/' . $this->picture->store('Products', 'public'),
            'category_id' =>  $this->category,
            'supplier_id' =>  $this->supplier,
            'user_id' =>  Auth::user()->id,
        ]);

        // // session()->flash('message', 'Student Created Successfuly!');
        $this->resetInputFields();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم أضافة المنتج بنجاح',
        ]);
        
        $this->emit('addProduct');

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
        
        $this->emit('addCategory');

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
        
        $this->emit('addSupplier');

    }

    public function cart($id)
    {
        if ($id)
        {
            $product = Product::find($id);
            if ($product->quantity > 0){
                $productCart = Cart::where('product_id', $id)->where('user_id', Auth::user()->id)->first();
                if ($productCart){

                    $productCart->update([
                        'quantity' => $productCart->quantity + 1,
                    ]);

                    $product->update([
                        'quantity' => $product->quantity - 1,
                    ]);

                }else{
                    
                    Cart::create([
                        'quantity' => 1,
                        'product_id' => $product->id,
                        'user_id' =>  Auth::user()->id,
                    ]);

                    $product->update([
                        'quantity' => $product->quantity - 1,
                    ]);

                }
            } else {
                $this->dispatchBrowserEvent('swal:alert', [
                    'type' => 'error',
                    'title' => 'المنتج نفذ من المخزن',
                    'text' => '',
                ]);
            }

            $this->emit('cart');
            // return redirect()->route('home');
        }
    }


    public function render()
    {
        $categories = Category::where('status', 1)->get();
        $suppliers = Supplier::get();
        $setting = Setting::first();

        // $selectCategory = $this->selectCategory ;
        $categories = Category::get();
        if ($this->searchTerm == '') {
            $products = Product::where('status', 1)
                                ->where('category_id', $this->selectCategory == 0 ? '!=' : '=' , $this->selectCategory == 0 ? '0' : $this->selectCategory)
                                ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);
        } else {
            $searchTerm = '%' . $this->searchTerm .'%';
            $products = Product::where('status', 1)
                                ->where('category_id', $this->selectCategory == 0 ? '!=' : '=' , $this->selectCategory == 0 ? '0' : $this->selectCategory)
                                ->where('barcode', 'LIKE', $searchTerm)
                                ->orWhere('name', 'LIKE', $searchTerm)
                                ->orWhere('selling_price', 'LIKE', $searchTerm)
                                ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);
        }

        return view('livewire.products', [
            'setting' => $setting,
            'categories' => $categories,
            'suppliers' => $suppliers,
            'products' => $products,
        ]);

    }
}
