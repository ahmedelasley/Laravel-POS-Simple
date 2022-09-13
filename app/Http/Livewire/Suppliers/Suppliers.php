<?php

namespace App\Http\Livewire\Suppliers;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Suppliers extends Component
{


    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm ='';
    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $name, $email, $phone, $address, $picture, $status;
    public $ids ;


    public function resetInputFields()
    {
        $this->name    = '';
        $this->email   = '';
        $this->phone   = '';
        $this->address = '';
        $this->picture = '';
        $this->status = '';
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
            // 'email' => 'email',
            'phone' => 'required|digits:11|unique:suppliers,phone,'.$this->ids,
            'address' => 'string',

        ];
    }


    protected function messages ()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'هذا الحقل يجب أن يكون نص',
            'name.min' => 'يجب ألا يقل الاسم عن 6 أحرف.',

            'phone.required' => 'هذا الحقل مطلوب',
            'phone.unique' => 'الرقم مستخدم من قبل',
            'phone.digits' => 'يجب أن يتكون الهاتف من 11 رقمًا.',

            'address.string' => 'هذا الحقل يجب أن يكون نص',
            
            'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالحًا.',

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

        Supplier::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'user_id' =>  Auth::user()->id,
        ]);
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم أضافة المورد بنجاح',
        ]);
        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function edit(int $id) 
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $this->ids      = $supplier->id;
            $this->name     = $supplier->name;
            $this->email    = $supplier->email;
            $this->phone    = $supplier->phone;
            $this->address  = $supplier->address;
        } else {
            return redirect()->to('/suppliers');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Supplier::find($this->ids)->update([
            'name'      => $validatedData['name'] ,
            'email'     => $this->email ,
            'phone'     => $validatedData['phone'] ,
            'address'   => $validatedData['address'] ,
        ]);

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل بيانات المورد بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function editPicture(int $id) 
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $this->ids      = $supplier->id;
            $this->picture  = $supplier->picture;
        } else {
            return redirect()->to('/suppliers');
        }
    }

    public function updatePicture()
    {

        $this->validate([
            'picture' => 'image|max:1024', // 1MB Max
        ]);

        $supplier = Supplier::find($this->ids);
        if ($supplier->picture) {
            File::delete($supplier->picture);
        }
        $supplier->update([
            'picture' =>  'mahrousa/public/uploads/' . $this->picture->store('Suppliers', 'public'),
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل صورة المورد بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function status(int $id) 
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $this->ids      = $supplier->id;
            $this->status  = $supplier->status;
        } else {
            return redirect()->to('/suppliers');
        }
    }

    public function updateStatus()
    {

        $this->validate([
            'status'   => 'required|numeric',
        ]);

        Supplier::find($this->ids)->update([
            'status' =>  $this->status,
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل حالة المورد بنجاح',
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
        $supplier = Supplier::find($this->ids)->delete();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم حذف المورد بنجاح',
        ]);

        $this->dispatchBrowserEvent('close-modal');

    }





    public function render()
    {

        $searchTerm = '%' . $this->searchTerm .'%';
        $suppliers = Supplier::where('name', 'LIKE', $searchTerm)
                            ->orWhere('phone', 'LIKE', $searchTerm)
                            ->orWhere('address', 'LIKE', $searchTerm)
                            ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);


        return view('livewire.suppliers.suppliers',[
            'suppliers' => $suppliers,
        ]);
    }
}
