<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ShowProfile extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'editName' => '$refresh',
        'editEmail' => '$refresh',
        'editPhone' => '$refresh',
       
    ];
    public $picture;
    protected function messages ()
    {
        return [

            'picture.required'  => 'هذا الحقل مطلوب',
            'picture.image'     => 'هذا الحقل يجن أن يكون صورة',
            'picture.max'       => 'يجب ألا يزيد حجم الصورة عن 1024 كيلو بايت.',

           
        ];
    }
    public function editPicture(int $id) 
    {
        $customer = User::find($id);
        if ($customer) {
            $this->ids      = $customer->id;
            $this->picture  = $customer->picture;
        } else {
            return redirect()->to('/customers');
        }
    }

    public function updatePicture()
    {

        $this->validate([
            'picture' => 'required|image|max:1024', // 1MB Max
        ]);

        $customer = User::find($this->ids);
        if ($customer->picture) {
            File::delete($customer->picture);
        }
        $customer->update([
            'picture' =>  'mahrousa/public/uploads/' . $this->picture->store('Users', 'public'),
        ]);
        
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل الصورة الشخصية بنجاح',
        ]);

        $this->picture = '';
        $this->dispatchBrowserEvent('close-modal');

    }
    public function close()
    {
        $this->picture = '';
    }

    public function render()
    {
        $setting = Setting::first();
        $user = User::find(Auth::user()->id);


        return view('livewire.profile.show-profile',[
            'setting' => $setting,
            'user' => $user,

        ]);
    }
}
