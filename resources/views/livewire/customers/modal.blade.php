<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="createModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة مورد جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المورد</label>
                        <input class="form-control" type="text" name="name" wire:model='name' >
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">هاتف المورد</label>
                        <input class="form-control"type="text" name="phone" wire:model='phone'>
                        @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">عنوان المورد</label>
                        <input class="form-control" type="text" name="address" wire:model='address'>
                        @error('address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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

<!-- Update modal -->
<div wire:ignore.self class="modal fade" id="updateModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تعديل بيانات العميل</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المورد</label>
                        <input class="form-control" type="text" name="name" wire:model='name'>
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="email">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control" wire:model='email'>
                        @error('email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                      </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">هاتف المورد</label>
                        <input class="form-control"type="text" name="phone" wire:model='phone'>
                        @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">عنوان المورد</label>
                        <input class="form-control" type="text" name="address" wire:model='address'>
                        @error('address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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

<!-- Delete modal -->
<div wire:ignore.self class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <div class="modal-header">
                    <h6 class="modal-title">حذف العميل</h6>
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
                        <label for="picture" class="d-block">صورة العميل</label>

                        @if ( $picture !== NULL && method_exists($picture ,'temporaryUrl'))
                            <img src="{{ $picture->temporaryUrl() }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarLive">
                        @elseif($picture)
                            <img src="{{ URL::asset($picture) }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarData">
                        @elseif ($this->picture == NULL)
                            <img src="{{ URL::asset('mahrousa/public/uploads/person.jpg') }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="Avatar">
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
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="updatePicture()" >تغيير</button>
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