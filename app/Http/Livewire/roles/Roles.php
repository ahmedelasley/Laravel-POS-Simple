<?php

namespace App\Http\Livewire\Roles;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class Roles extends Component
{

    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $searchTerm ='';
    public $paginateCount = 10;
    public $sortBy = 'id';
    public $orderBy ='ASC';

    public $name, $permission = [], $rolePermissions , $rolePermission ;
    public $ids ;


    public function resetInputFields()
    {
        $this->name    = '';
        $this->permission   = '';

    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3|unique:roles,name,'.$this->ids,
            'permission' => 'required',
        ];
    }


    protected function messages ()
    {
        return [
            'name.required' => 'هذا الحقل مطلوب',
            'name.string' => 'هذا الحقل يجب أن يكون نص',
            'name.min' => 'يجب ألا يقل الاسم عن 3 أحرف.',
            'name.unique' => 'اسم الصلاحية مستخدمه من قبل',

            'permission.required' => 'يجب أختيار أذن واحد علي الأقل',

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

        $role = Role::create([
            'name' => $this->name,

        ]);
        $role->syncPermissions($this->permission);

        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم أضافة الصلاحية بنجاح',
        ]);
        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-modal');

    }


    public function view(int $id) 
    {
        $role = Role::find($id);
        if ($role) {
            $this->ids      = $role->id;
            $this->name     = $role->name;
            $this->rolePermission = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")->where("role_has_permissions.role_id",$id)->get();

        } else {
            return redirect()->to('/roles');
        }
    }





    public function edit(int $id) 
    {
        $role = Role::find($id);
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

        if ($role) {

            $this->ids      = $role->id;
            $this->name     = $role->name;
            $this->rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$this->ids)->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')->all();

            
        } else {
            return redirect()->to('/roles');
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        $role = Role::find($this->ids);
        $role->update([
            'name' => $validatedData['name'] ,
        ]);
        // DB::table("role_has_permissions")->where('role_id',$this->ids)->delete();

        $role->syncPermissions($this->permission);
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'success',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم تعديل بيانات الصلاحية بنجاح',
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
        $role = Role::find($this->ids)->delete();
        $this->dispatchBrowserEvent('swal:alert', [
            'icon' => 'error',
            'title' => 'العملية تمت بنجاح',
            'text' => 'تم حذف الصلاحية بنجاح',
        ]);

        $this->dispatchBrowserEvent('close-modal');

    }





    public function render()
    {

        $searchTerm = '%' . $this->searchTerm .'%';
        $roles = Role::where('name', 'LIKE', $searchTerm)
                            ->orderBy($this->sortBy, $this->orderBy)->paginate($this->paginateCount);

        return view('livewire.roles.roles',[
            'roles' => $roles,
        ]);
    }
}
