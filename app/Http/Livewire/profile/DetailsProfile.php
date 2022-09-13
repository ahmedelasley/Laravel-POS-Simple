<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DetailsProfile extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'changeLogo' => '$refresh',
    ];
    public $searchTerm ='';
    public $searchDate = '';
    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $name;
    public $email;
    public $phone;
    public $old_password;
    public $new_password;
    public $confirm_password;


    protected function messages ()
    {
        return [
            'name.string' => 'هذا الحقل يجب أن يكون نص',

            'phone.unique' => 'الرقم مستخدم من قبل',
            'phone.digits' => 'يجب أن يتكون الهاتف من 11 رقمًا.',

            'email.unique' => 'الرقم مستخدم من قبل',
            'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالحًا.',

            'password.required' => 'هذا الحقل مطلوب',
            'old_password.required' => 'هذا الحقل مطلوب',
            'new_password.required' => 'هذا الحقل مطلوب',
            'confirm_password.required' => 'هذا الحقل مطلوب',
            'confirm_password.same' => 'تأكيد كلمة المرور',


            'old_password.min' => 'يجب ألا يقل كلمة المرور عن 8 أحرف.',
            'new_password.min' => 'يجب ألا يقل كلمة المرور عن 8 أحرف.',



           
        ];
    }


    public function editName()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
        ]);
        User::find(1)->update($validatedData);
        $this->emit('editName');
    }

    public function editEmail()
    {
        $validatedData = $this->validate([
            'email' => 'required|email|unique:users,email,'. Auth::user()->id,
        ]);
        User::find(1)->update($validatedData);
        $this->emit('editEmail');
    }

    public function editPhone()
    {
        $validatedData = $this->validate([
            'phone' => 'required|digits:11|unique:users,phone,'. Auth::user()->id,
        ]);
        User::find(1)->update($validatedData);
        $this->emit('editPhone');
    }

    public function updatePassword()
    {
        $validatedData = $this->validate([
            'old_password'      => 'required|min:8|max:100',
            'new_password'      => 'required|min:8|max:100',
            'confirm_password' => 'required|same:new_password',
        ]);



        $current_user = Auth::user();
        if (Hash::check( $this->old_password, $current_user->password)) {
            $current_user->update([
                'password' => bcrypt($validatedData['new_password'])
            ]);
            $this->dispatchBrowserEvent('swal:alert', [
                'icon' => 'success',
                'title' => 'العملية تمت بنجاح',
                'text' => 'تم تعديل كلمة المرور بنجاح',
            ]);
            $this->old_password = '';
            $this->new_password = '';
            $this->confirm_password = '';
        } else {
            $this->dispatchBrowserEvent('swal:alert', [
                'icon' => 'error',
                'title' => 'خطأ ! كلمة المرور القديمة غير صحيحه',
                'text' => '',
            ]);
        }
        


    }


    public function render()
    {
        $setting = Setting::first();
        $user = User::find(Auth::user()->id);

        $searchTerm = '%' . $this->searchTerm .'%';
        $searchDate = '%' . $this->searchDate .'%';


        $orders = Order::where('user_id', Auth::user()->id)
                        ->where('barcode', 'LIKE', $searchTerm)
                        ->orWhere('created_at', 'LIKE', $searchDate)
                        ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);

        return view('livewire.profile.details-profile',[
            'setting' => $setting,
            'user' => $user,
            'orders' => $orders,
        ]);
    }
}
