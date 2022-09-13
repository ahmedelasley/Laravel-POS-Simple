<?php

namespace App\Http\Livewire;

use livewire;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Customer;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;

class Carts extends Component
{

    protected $listeners = [
        'cart' => '$refresh',
        'addCategory' =>'$refresh',
        'addSupplier' =>'$refresh',
    ];



    public $barcodeProduct;
    public $name;
    public $phone;
    public $address;
    public $phoneClient = 0;
    public $subTotal;
    public $amount;

    protected function messages ()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'هذا الحقل يجب أن يكون نص',
            'name.min' => 'يجب ألا يقل الاسم عن 6 أحرف.',

            'phone.required' => 'هذا الحقل مطلوب',
            'phone.unique' => 'الرقم مستخدم من قبل',
            'phone.digits' => 'يجب أن يتكون الهاتف من 11 رقمًا.',

            'address.required' => 'هذا الحقل مطلوب',
            'address.string' => 'هذا الحقل يجب أن يكون نص',
            
            'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالحًا.',

            'picture.required' => 'هذا الحقل مطلوب',
            'picture.max' => 'يجب ألا يزيد حجم الصورة عن 1024 كيلو بايت.',

            'amount.numeric' => 'يجب أن يكون المبلغ رقم',
            'amount.required' => 'يجب دفع المبلغ أولا',

        ];
    }

    public function resetInputFields()
    {
        $this->name    = '';
        $this->phone   = '';
        $this->address = '';
    }
    public function decreaseQuantity($id)
    {
        $productCart = Cart::find($id);
        $productCart->update([
            'quantity' => $productCart->quantity - 1,
        ]);

        $product = Product::where('id', $productCart->product_id)->first();
        $product->update([
            'quantity' => $product->quantity + 1,
        ]);
        if($productCart->quantity == 0){
            $this->dispatchBrowserEvent('swal:alert', [
                'icon' => 'error',
                'title' => 'حذف المنتج من السلة',
                'text' => '',
            ]);
            $productCart->delete();

        }
        $this->emit('decrease');
    }

    public function increaseQuantity($id)
    {
        $productCart = Cart::find($id);
        $product = Product::where('id', $productCart->product_id)->first();

        if($product->quantity == 0){
            $this->dispatchBrowserEvent('swal:alert', [
                'icon' => 'error',
                'title' => 'المنتج نفذ من المخزن',
                'text' => '',
            ]);
        }else {
            $productCart->update([
                'quantity' => $productCart->quantity + 1,
            ]);
    
            $product->update([
                'quantity' => $product->quantity - 1,
            ]);
        }

        $this->emit('increase');
    }

    public function deleteProduct($id)
    {
        $productCart = Cart::find($id);
        $product = Product::where('id', $productCart->product_id)->first();
    
        $product->update([
            'quantity' => $product->quantity + $productCart->quantity,
        ]);

        $productCart->delete();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'حذف المنتج من السلة',
            'text' => '',
        ]);
        $this->emit('deleteProduct');
    }

    public function barcode()
    {

        // $barcodeProduct = $this->barcodeProduct;
        $product = Product::where('barcode', $this->barcodeProduct)->first();
        $id = $product->id;
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


        $this->barcodeProduct = '';





        // $this->dispatchBrowserEvent('swal:max', [
        //     'type' => 'error',
        //     'title' => $product->name,
        //     'text' => $product->barcode,
        // ]);

        $this->emit('barcode');
    }


    public function storeCustomer()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'phone' => 'required|unique:customers|digits:11',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Customer::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'user_id' =>  Auth::user()->id,
        ]);


        $this->resetInputFields();

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم أضافة العميل بنجاح',
        ]);
        $this->emit('addCustomer');


        
    }

    public function cancelCart()
    {
        if (Cart::count() > 0) {
            $productsCart = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($productsCart as $productCart) {
                
                $product = Product::where('id', $productCart->product_id)->first();
                $product->update([
                    'quantity' => $product->quantity + $productCart->quantity,
                ]);

            }

            Cart::where('user_id', Auth::user()->id)->delete();
            $this->dispatchBrowserEvent('swal:alert', [
                'icon' => 'info',
                'title' => 'تفريغ',
                'text' => 'تم تفريغ السلة بنجاح',
            ]);
            $this->emit('cancelCart');
        }
    }

    public function pay()
    {

        if (Cart::count() > 0) {

            $validatedData = $this->validate([
                'amount' => 'required',
            ]);



            $getCustomer = Customer::where('phone', 'LIKE', '%'.$this->phoneClient.'%')->first();
            // $customerId = $getCustomer->id;

            Order::create([
                'amount' => floatval($this->amount),
                'customer_id' => $getCustomer->id,
                'user_id' =>  Auth::user()->id,
            ]);
            $orderID = Order::latest()->first()->id;
            Order::find($orderID)->update([
                'barcode' => date('Y') . date('m') . date('d') . $orderID,
            ]);

            $productsCart = Cart::where('user_id', Auth::user()->id)->get();

            foreach ($productsCart as $productCart) {
                $product = Product::where('id', $productCart->product_id)->first();
                OrderProduct::create([
                    'quantity'  => $productCart->quantity,
                    'price'  => ($product->selling_price) - ( ($product->selling_price * $product->discount) / 100),
                    'order_id' => $orderID,
                    'product_id' => $productCart->product_id,
                ]);
                

            }

            Cart::where('user_id', Auth::user()->id)->delete();
            $this->amount = 0;

            $this->dispatchBrowserEvent('swal:alert', [
                'icon' => 'success',
                'title' => 'العملية تمت بنجاح',
                'text' => 'تمت عملية الدفع بنجاح',
            ]);
            $this->emit('pay');
            return redirect()->route('receipt', ['id' => $orderID]);
            // @livewire('order', ['id' => $orderID]);
            // <livewire:order :id="$orderID">
        }


    }

    public function render()
    {

        $amount = floatval($this->amount);
        $phoneClient = $this->phoneClient;

        // $client1 = Customer::where('phone', $phoneClient )->first();
        // $client1 = $client2 == NULL ? '' : $client2 ;
        $carts = Cart::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        $customers = Customer::get();
        $setting = Setting::first();
        return view('livewire.carts', [
            'setting' => $setting,
            'carts' => $carts,
            'customers' => $customers,
            // 'client1' => $client1,
            // 'amount1' => $amount,

        ]);
    }
}
