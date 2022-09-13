<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{

    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm ='';
    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $name, $email, $phone, $password, $confirm_password, $picture, $roles_name=[], $status;
    public $ids ;
    public $userRole;
    public $old_password;
    public $new_password;
    // public $confirm_password;


    public function resetInputFields()
    {
        $this->name    = '';
        $this->email   = '';
        $this->phone   = '';
        $this->password = '';
        // $this->confirm_password = '';
        $this->picture = '';
        $this->status = '';
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email,'.$this->ids,
            'phone' => 'required|digits:11|unique:users,phone,'.$this->ids,
            // 'password' => 'required|same:confirm_password',
            'roles_name' => 'required',

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

            'email.required' => 'هذا الحقل مطلوب', 
            'email.unique' => 'الرقم مستخدم من قبل',
            'email.email' => 'يجب أن يكون البريد الإلكتروني عنوان بريد إلكتروني صالحًا.',

            'password.required' => 'هذا الحقل مطلوب',
            'old_password.required' => 'هذا الحقل مطلوب',
            'new_password.required' => 'هذا الحقل مطلوب',
            'confirm_password.required' => 'هذا الحقل مطلوب',
            'password.same' => 'تأكيد كلمة المرور',
            'confirm_password.same' => 'تأكيد كلمة المرور',

            
            'old_password.min' => 'يجب ألا يقل كلمة المرور عن 8 أحرف.',
            'new_password.min' => 'يجب ألا يقل كلمة المرور عن 8 أحرف.',

            'roles_name.required' => 'هذا الحقل مطلوب',

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

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'roles_name' => $this->roles_name,
        ]);
        $user->assignRole($this->roles_name);
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم أضافة المستخدم بنجاح',
        ]);
        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }


    public function view(int $id) 
    {
        $user = User::find($id);
        if ($user) {
            $this->ids      = $user->id;
            $this->name     = $user->name;
            $this->email     = $user->email;
            $this->phone     = $user->phone;
            $this->status     = $user->status;
            $this->picture     = $user->picture;
            $this->roles_name     = $user->roles_name;

        } else {
            return redirect()->to('/roles');
        }
    }

    public function edit(int $id) 
    {
        $user = User::find($id);
        if ($user) {
            $this->ids      = $user->id;
            $this->name     = $user->name;
            $this->email    = $user->email;
            $this->phone    = $user->phone;
            $this->userRole = $user->roles->pluck('name','name')->all();
        } else {
            return redirect()->to('/Users');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        $user = User::find($this->ids);
        $user->update([
            'name'      => $validatedData['name'] ,
            'email'     => $validatedData['email'] ,
            'phone'     => $validatedData['phone'] ,
            'roles_name' => $this->roles_name,
        ]);
        DB::table('model_has_roles')->where('model_id', $this->ids)->delete();

        $user->assignRole($this->roles_name);

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل بيانات المستخدم بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }





    public function editPassword(int $id) 
    {
        $user = User::find($id);
        if ($user) {
            $this->ids      = $user->id;
            // $this->old_password  = $user->password;
        } else {
            return redirect()->to('/users');
        }
    }
    public function updatePassword()
    {
        $validatedData = $this->validate([
            // 'old_password'      => 'required|min:8|max:100',
            'new_password'      => 'required|min:8|max:100',
            'confirm_password' => 'required|same:new_password',
        ]);

        $current_user = User::find($this->ids);

        // if (Hash::check( $this->old_password, $current_user->password)) {

            $current_user->update([
                'password' => bcrypt($validatedData['new_password'])
            ]);
            $this->dispatchBrowserEvent('swal:alert', [
                'icon' => 'success',
                'title' => 'العملية تمت بنجاح',
                'text' => 'تم تعديل كلمة المرور بنجاح',
            ]);

        // } else {
        //     $this->dispatchBrowserEvent('swal:alert', [
        //         'icon' => 'error',
        //         'title' => 'خطأ ! كلمة المرور القديمة غير صحيحه',
        //         'text' => '',
        //     ]);
        // } 

        // $this->old_password = '';
        $this->new_password = '';
        $this->confirm_password = '';

        $this->dispatchBrowserEvent('close-modal');
   

    }

    public function editPicture(int $id) 
    {
        $user = User::find($id);
        if ($user) {
            $this->ids      = $user->id;
            $this->picture  = $user->picture;
        } else {
            return redirect()->to('/users');
        }
    }

    public function updatePicture()
    {

        $this->validate([
            'picture' => 'image|max:1024', // 1MB Max
        ]);

        $user = User::find($this->ids);
        if ($user->picture) {
            File::delete($user->picture);
        }
        $user->update([
            'picture' =>  'mahrousa/public/uploads/' . $this->picture->store('Users', 'public'),
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل صورة المستخدم بنجاح',
        ]);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function status(int $id) 
    {
        $user = User::find($id);
        if ($user) {
            $this->ids      = $user->id;
            $this->status  = $user->status;
        } else {
            return redirect()->to('/users');
        }
    }

    public function updateStatus()
    {

        $this->validate([
            'status'   => 'required|numeric',
        ]);

        User::find($this->ids)->update([
            'status' =>  $this->status,
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل حالة المستخدم بنجاح',
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
        $users = User::find($this->ids)->delete();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم حذف المستخدم بنجاح',
        ]);

        $this->dispatchBrowserEvent('close-modal');

    }





    public function render()
    {
        $setting = Setting::first();
        $roles = Role::pluck('name','name')->all();
        $searchTerm = '%' . $this->searchTerm .'%';
        $users = User::where('name', 'LIKE', $searchTerm)
                            ->orWhere('phone', 'LIKE', $searchTerm)
                            // ->orWhere('address', 'LIKE', $searchTerm)
                            ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);

        return view('livewire.users.users',[
            'setting' => $setting,
            'roles' => $roles,
            'users' => $users,
        ]);
    }
}
