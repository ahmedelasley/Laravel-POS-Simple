<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="createModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة مستخدم جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المستخدم</label>
                        <input class="form-control" type="text" name="name" wire:model='name' >
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الألكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" wire:model='email' >
                        @error('email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">هاتف المستخدم</label>
                        <input class="form-control"type="text" name="phone" wire:model='phone'>
                        @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="password">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password" wire:model="password" >
                        @error('password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" wire:model="confirm_password"  >
                        @error('confirm_password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="roles">صلاحيات</label>
                        {!! Form::select('roles_name', $roles,null, array('class' => 'form-control','wire:model' => 'roles_name','multiple')) !!}
                        {{-- <select wire:model="roles_name" name="roles_namep" id="roles_name" class="form-control" multiple>
                            @foreach($roles as $role)
                                <option value={{$role->name}}>{{ $role->name }}</option>
                            @endforeach
                        </select> --}}
                        @error('roles_name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="store()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Create modal -->

<!-- View modal -->
<div wire:ignore.self class="modal fade" id="viewModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">الصفحة الشخصية للمستخدم {{ $name }}</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">

                    
                                <div class="main-profile-overview">
                                    <div class="main-img-user profile-user px-auto">
                                    @if ($this->picture)
                                        <img src="{{ URL::asset($this->picture) }}" class="">
                                    @else
                                        <img src="{{ URL::asset('mahrousa/public/uploads/person.jpg') }}" class="">
                                    @endif
                                    </div>
                                    <div class="d-flex justify-content-between mg-b-20">
                                        <div>
                                            <h5 class="main-profile-name">
                                                {{ $this->name}}
                                                @if ($this->status == 0)
                                                    <span class="label text-danger d-flex"><div class="dot-label bg-danger ml-1"></div>
                                                        غير نشط
                                                    </span>
                                                @else
                                                    <span class="label text-success d-flex"><div class="dot-label bg-success ml-1"></div>
                                                        نشط
                                                    </span>
                                                @endif
                                            </h5>
                                            <p class="main-profile-name-text">
                                                @if (!empty($this->roles_name))
                                                    @foreach ($this->roles_name as $key => $role)
                                                    <label class="badge badge-primary">{{ $role }}</label>
                                                    @endforeach
                                                @endif

                                            </p>
                                        </div>
                                    </div>
                
                                    <div class="row  text-center">
                                        <div class="col-md-4 col mb20">
                                            <h5>{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y-m-d').'%')->where('user_id', $this->ids)->count() }}</h5>
                                            <h6>{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y-m-d').'%')->where('user_id', $this->ids)->sum('amount'), $setting->price) }}</h6>
                                            <h6 class="text-small text-muted mb-0">مبيعات اليوم</h6>
                                        </div>
                                        <div class="col-md-4 col mb20">
                                            <h5>{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y-m').'%')->where('user_id', $this->ids)->count() }}</h5>
                                            <h6>{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y-m').'%')->where('user_id', $this->ids)->sum('amount'), $setting->price) }}</h6>
                                            <h6 class="text-small text-muted mb-0">مبيعات الشهر</h6>
                                        </div>
                                        <div class="col-md-4 col mb20">
                                            <h5>{{ \App\Models\Order::where('created_at', 'like', '%'.date('Y').'%')->where('user_id', $this->ids)->count() }}</h5>
                                            <h6>{{ number_format(\App\Models\Order::where('created_at', 'like', '%'.date('Y').'%')->where('user_id', $this->ids)->sum('amount'), $setting->price) }}</h6>
                                            <h6 class="text-small text-muted mb-0">مبيعات السنه</h6>
                                        </div>
                                    </div>
                                    <hr class="mg-y-30">
                                    <label class="main-content-label tx-13 mg-b-20">للأتصال</label>
                                    <div class="main-profile-social-list">
                                        <div class="media">
                                            <div class="media-icon bg-primary-transparent text-primary">
                                                <i class="icon ion-md-phone-portrait"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Mobile</span>
                                                <div>{{ $this->phone }}</div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-icon bg-success-transparent text-success">
                                                <i class="fa fa-envelope"></i>
                                            </div>
                                            <div class="media-body">
                                                <span>Email</span>
                                                <div>{{ $this->email }}</div>
                                            </div>
                                        </div>
                                    </div>
                
                                    
                                </div><!-- main-profile-overview -->

                            
                    
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>

        </div>
    </div>
</div>
<!-- End View modal -->

<!-- Update modal -->
<div wire:ignore.self class="modal fade" id="updateModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل بيانات المستخدم</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المستخدم</label>
                        <input class="form-control" type="text" name="name" wire:model='name' >
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الألكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" wire:model='email' >
                        @error('email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">هاتف المستخدم</label>
                        <input class="form-control"type="text" name="phone" wire:model='phone'>
                        @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="roles">صلاحيات</label>
                        {!! Form::select('roles_name', $roles, $userRole, array('class' => 'form-control','wire:model' => 'roles_name','multiple')) !!}
                        @error('roles_name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="update()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Update modal -->

<!-- Password modal -->
<div wire:ignore.self class="modal fade" id="passwordModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل كلمة المرور للمستخدم</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >

                    <!-- <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">كلمة المرور القديمة</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="old_password" name="old_password" wire:model="old_password" >
                                @error('old_password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">كلمة المرور الجديدة</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="new_password" name="new_password" wire:model="new_password" >
                                @error('new_password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                            </div>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" wire:model="confirm_password"  >
                                @error('confirm_password')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="updatePassword()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Password modal -->

<!-- Delete modal -->
<div wire:ignore.self class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المستخدم</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form" >
                        <h1>هل أنت متأكد من عملية الحذف ؟</h1>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="button" wire:click.prevent="destroy()">نعم !</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Delete modal -->

<!-- Picture modal -->
<div wire:ignore.self class="modal fade" id="pictureModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تغيير الصورة</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form id="form"  enctype="multipart/form-data" >
                <div class="form-group">
                    <div
                        x-data="{ isUploading: true, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = true"
                        x-on:livewire-upload-error="isUploading = true"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <label for="picture" class="d-block">صورة المستخدم</label>

                        @if ( $picture !== NULL && method_exists($picture ,'temporaryUrl'))
                            <img src="{{ $picture->temporaryUrl() }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarLive">
                        @elseif($picture)
                            <img src="{{ URL::asset($picture) }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarData">
                        @elseif ($this->picture == NULL)
                            <img src="{{ URL::asset('uploads/person.jpg') }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="Avatar">
                        @endif

                        <input type="file" name="picture" class="form-control" wire:model='picture'>
                        @error('picture')<span class="text-danger">{{ $message }}</span>@enderror
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>

            </form>
                    
                
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="updatePicture()" >حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>

        </div>
    </div>
</div>
<!-- End Picture modal -->

<!-- Status modal -->
<div wire:ignore.self class="modal fade" id="statusModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تغيير الحالة</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <form id="form" >
                <div class="form-group py-5">
                    <input class="form-control" type="radio" name="status" wire:model='status' id="yes" value="1" />
                    <input class="form-control" type="radio" name="status" wire:model='status' id="no" value="0"/>
                    <div class="switch">
                      <label for="yes" class="">نشط</label>
                      <label for="no" class="main-content-label tx-12 tx-medium">غير نشط</label>
                      <span></span>
                    </div>


                </div>

            </form>
                    
                
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="updateStatus()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>

        </div>
    </div>
</div>
<!-- End Status modal -->