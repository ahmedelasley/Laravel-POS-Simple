<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class EditSetting extends Component
{
    protected $listeners = [
        'changeLogo' => '$refresh',
    ];

    public $name;
    public $type;
    public $description;
    public $email;
    public $phone;
    public $address;
    public $currency;
    public $price;
    public $quantity;
    public $notes;

    public function editName()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editName');
    }

    public function editType()
    {
        $validatedData = $this->validate([
            'type' => 'required|string',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editType');
    }

    public function editDescription()
    {
        $validatedData = $this->validate([
            'description' => 'required|string',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editDescription');
    }

    public function editEmail()
    {
        $validatedData = $this->validate([
            'email' => 'required|email',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editEmail');
    }

    public function editPhone()
    {
        $validatedData = $this->validate([
            'phone' => 'required|digits:11',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editPhone');
    }

    public function editAddress()
    {
        $validatedData = $this->validate([
            'address' => 'required|string',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editAddress');
    }

    public function editCurrency()
    {
        $validatedData = $this->validate([
            'currency' => 'required|string',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editCurrency');
    }

    public function editPrice()
    {
        $validatedData = $this->validate([
            'price' => 'required|digits:1',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editPrice');
    }

    public function editQuantity()
    {
        $validatedData = $this->validate([
            'quantity' => 'required|digits:1',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editQuantity');
    }

    public function editNotes()
    {
        $validatedData = $this->validate([
            'notes' => 'required|string',
        ]);
        Setting::find(1)->update($validatedData);
        $this->emit('editNotes');
    }

    public function render()
    {
        return view('livewire.edit-setting');
    }
}
