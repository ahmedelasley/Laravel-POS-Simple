<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class ShowSetting extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'editName' => '$refresh',
        'editType' => '$refresh',
        'editDescription' => '$refresh',
        'editEmail' => '$refresh',
        'editPhone' => '$refresh',
        'editAddress' => '$refresh',
        'editCurrency' => '$refresh',
        'editPrice' => '$refresh',
        'editQuantity' => '$refresh',
        'editNotes' => '$refresh',
        
    ];
    public $picture;
    protected function messages ()
    {
        return [

            'picture.required' => 'هذا الحقل مطلوب',
            'picture.max' => 'يجب ألا يزيد حجم الصورة عن 1024 كيلو بايت.',

           
        ];
    }
    public function changeLogo()
    {
        
        $this->validate([
            'picture' => 'required|max:1024',
        ]);
        if (1)
        {
            $setting = Setting::find(1);
            if ($setting->picture) {
                File::delete($setting->picture);
            }
            $setting->update([
                'picture' =>  'mahrousa/public/uploads/' . $this->picture->store('Logo', 'public'),
            ]);
            // File::move($this->picture);
        }


        $this->picture = '';
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل شعار البرنامج بنجاح',
        ]);
        
        $this->emit('changeLogo');
    }
    public function render()
    {
        // return view('livewire.show-setting');
        $setting = Setting::first();
        return view('livewire.show-setting',[
            'setting' => $setting,
        ]);
    }
}
