<div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
    
    <div class="card">
        <div class="card-body">
            <div class="mb-4 main-content-label">تعديل بيانات البرنامج</div>
            {{-- <form class="form-horizontal"> --}}

                <div class="mb-4 main-content-label">الأسم</div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">أسم الخدمة</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="أسم الخدمة" wire:model="name" wire:keydown.enter="editName()">
                            @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">نوع الخدمة</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="نوع الخدمة" wire:model="type" wire:keydown.enter="editType()">
                            @error('type')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">وصف الخدمة</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="وصف الخدمة" wire:model="description" wire:keydown.enter="editDescription()">
                            @error('description')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>



                <div class="mb-4 main-content-label">معلومات الأتصال</div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">البريد الإلكتروني</label>
                        </div>
                        <div class="col-md-9">
                            <input type="email" class="form-control"  placeholder="البريد الإلكتروني" wire:model="email" wire:keydown.enter="editEmail()">
                            @error('email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">الهاتف</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="الهاتف" wire:model="phone" wire:keydown.enter="editPhone()">
                            @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">العنوان</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="العنوان" wire:model="address" wire:keydown.enter="editAddress()">
                            @error('address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="mb-4 main-content-label">معلومات البرنامج</div>
                
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">العملة</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="العملة" wire:model="currency" wire:keydown.enter="editCurrency()">
                            @error('currency')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">التقريب العشري للأسعار</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="التقريب العشري للأسعار" wire:model="price" wire:keydown.enter="editPrice()">
                            @error('price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">التقريب العشري للكميات</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="التقريب العشري للكميات" wire:model="quantity" wire:keydown.enter="editQuantity()">
                            @error('quantity')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">ملاحظات</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control"  placeholder="ملاحظات" wire:model="notes" wire:keydown.enter="editNotes()">
                            @error('notes')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

                            {{-- <textarea class="form-control" name="example-textarea-input" rows="4" placeholder="">pleasure rationally encounter but because pursue consequences that are extremely painful.occur in which toil and pain can procure him some great pleasure..</textarea> --}}
                        </div>
                    </div>
                </div>

            {{-- </form> --}}
        </div>
        {{-- <div class="card-footer text-left">
            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Profile</button>
        </div> --}}
    </div>


</div>
