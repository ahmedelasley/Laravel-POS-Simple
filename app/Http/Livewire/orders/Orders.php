<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\OrderProduct;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class Orders extends Component
{


    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm ='';
    public $searchDate = '';
    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $barcode, $amount, $customer_id, $user_id, $created_at, $orderProducts;
    public $ids ;

    public $customer_name, $customer_phone, $customer_address, $user_name;


    public function resetInputFields()
    {
        $this->barcode    = '';
        $this->amount   = '';
    }

    // protected function rules()
    // {
    //     return [
    //         'name' => 'required|string|min:6',
    //         // 'email' => 'email',
    //         'phone' => 'required|digits:11|unique:suppliers,phone,'.$this->ids,
    //         'address' => 'string',

    //     ];
    // }


    // protected function messages ()
    // {
    //     return [
    //         'name.required' => 'هذا الحقل مطلوب',
    //         'name.string' => 'هذا الحقل يجب أن يكون نص',
    //         'name.min' => 'يجب ألا يقل الاسم عن 6 أحرف.',

    //         'phone.required' => 'هذا الحقل مطلوب',
    //         'phone.unique' => 'الرقم مستخدم من قبل',
    //         'phone.digits' => 'يجب أن يتكون الهاتف من 11 رقمًا.',

    //         'address.string' => 'هذا الحقل يجب أن يكون نص',
            
    //         'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالحًا.',

    //         'picture.required' => 'هذا الحقل مطلوب',
    //         'picture.max' => 'يجب ألا يزيد حجم الصورة عن 1024 كيلو بايت.',

           
    //     ];
    // }

    // public function updated($field)
    // {
    //     $this->validateOnly($field);
    // }

    public function close()
    {
        $this->resetInputFields();

    }

    
    // public function store()
    // {
    //     $validatedData = $this->validate();

    //     Supplier::create([
    //         'name' => $this->name,
    //         'phone' => $this->phone,
    //         'address' => $this->address,
    //         'user_id' =>  Auth::user()->id,
    //     ]);
    //     $this->dispatchBrowserEvent('swal:alert', [
    //         'icon' => 'success',
    //         'title' => 'Add',
    //         'text' => 'A new Supplier has been added successfully',
    //     ]);
    //     $this->resetInputFields();
    //     $this->dispatchBrowserEvent('close-modal');

    // }

    // public function view(int $id) 
    // {
    //     $order = Order::find($id);
    //     if ($order) {
    //         $this->ids          = $order->id;
    //         $this->barcode      = $order->barcode;
    //         $this->amount       = $order->amount;
    //         $this->customer_id  = $order->customer_id;
    //         $this->user_id      = $order->user_id;
    //         $this->created_at   = $order->created_at;
    //     } else {
    //         return redirect()->to('/orders');
    //     }
    // }

    
    public function view(int $id) 
    {
        $order = Order::find($id);
        if ($order) {
            $this->orderProducts = OrderProduct::with('product')->where('order_id', $this->ids)->get();
            $this->ids          = $order->id;
            $this->barcode      = $order->barcode;
            $this->amount       = $order->amount;

            $this->user_name  = $order->user->name;

            $this->customer_name         = $order->customer->name;
            $this->customer_phone        = $order->customer->phone;
            $this->customer_address      = $order->customer->address;
            $this->created_at   = $order->created_at;
        } else {
            return redirect()->to('/orders');
        }
    }

    // public function update()
    // {
    //     $validatedData = $this->validate();
    //     Supplier::find($this->ids)->update([
    //         'name'      => $validatedData['name'] ,
    //         'email'     => $this->email ,
    //         'phone'     => $validatedData['phone'] ,
    //         'address'   => $validatedData['address'] ,
    //     ]);

    //     $this->dispatchBrowserEvent('swal:alert', [
    //         'icon' => 'success',
    //         'title' => 'Edit',
    //         'text' => 'A new Supplier has been added successfully',
    //     ]);

    //     $this->resetInputFields();
    //     $this->dispatchBrowserEvent('close-modal');

    // }

    // public function editPicture(int $id) 
    // {
    //     $supplier = Supplier::find($id);
    //     if ($supplier) {
    //         $this->ids      = $supplier->id;
    //         $this->picture  = $supplier->picture;
    //     } else {
    //         return redirect()->to('/suppliers');
    //     }
    // }

    // public function updatePicture()
    // {

    //     $this->validate([
    //         'picture' => 'image|max:1024', // 1MB Max
    //     ]);

    //     $supplier = Supplier::find($this->ids);
    //     $supplier->update([
    //         'picture' =>  'uploads/' . $this->picture->store('Suppliers', 'public'),
    //     ]);
        
    //     $this->dispatchBrowserEvent('swal:alert', [
    //         'icon' => 'success',
    //         'title' => 'Change Picture',
    //         'text' => 'A new Supplier has been added successfully',
    //     ]);

    //     $this->resetInputFields();
    //     $this->dispatchBrowserEvent('close-modal');

    // }

    // public function status(int $id) 
    // {
    //     $supplier = Supplier::find($id);
    //     if ($supplier) {
    //         $this->ids      = $supplier->id;
    //         $this->status  = $supplier->status;
    //     } else {
    //         return redirect()->to('/suppliers');
    //     }
    // }

    // public function updateStatus()
    // {

    //     $this->validate([
    //         'status'   => 'required|numeric',
    //     ]);

    //     Supplier::find($this->ids)->update([
    //         'status' =>  $this->status,
    //     ]);
        
    //     $this->dispatchBrowserEvent('swal:alert', [
    //         'icon' => 'success',
    //         'title' => 'Change Status',
    //         'text' => 'A new Supplier has been added successfully',
    //     ]);

    //     $this->resetInputFields();
    //     $this->dispatchBrowserEvent('close-modal');

    // }

    public function delete($id)
    {
        $this->ids = $id;
    }
    
    public function destroy()
    {
        $order = Order::find($this->ids);


        $orderProducts = OrderProduct::where('order_id', $this->ids)->get();
        foreach ($orderProducts as $orderProduct) {
            
            $product = Product::where('id', $orderProduct->product_id)->first();
            $product->update([
                'quantity' => $product->quantity + $orderProduct->quantity,
            ]);

        }

        $order->delete();

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم حذف الفاتورة بنجاح',
        ]);

        $this->dispatchBrowserEvent('close-modal');

    }
    public function deleteProduct($id)
    {
        $orderProduct = OrderProduct::find($id);
        $product = Product::where('id', $orderProduct->product_id)->first();
    
        $product->update([
            'quantity' => $product->quantity + $orderProduct->quantity,
        ]);

        $orderProduct->delete();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم حذف المنتج من الفاتورة بنجاح',
        ]);
        // $this->emit('deleteProduct');
    }




    public function render()
    {

        $searchTerm = '%' . $this->searchTerm .'%';
        $searchDate = '%' . $this->searchDate .'%';
        $setting = Setting::first();
        // $orders = Order::where('barcode', 'LIKE', $searchTerm)
        //                 ->orWhere('amount', 'LIKE', $searchTerm)
        //                 ->orWhere('created_at', 'LIKE', $searchDate)
        //                 ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);

        $orders = Order::where('barcode', 'LIKE', $searchTerm)
                        ->where('created_at', 'LIKE', $searchDate)
                        ->orderBy($this->sortBy, $this->orderBy)
                        ->paginate($this->paginateCount);

        return view('livewire.orders.orders',[
            'setting' => $setting,
            'orders' => $orders,
        ]);
    }
}
