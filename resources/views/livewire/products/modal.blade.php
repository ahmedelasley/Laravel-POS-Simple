<!-- Create modal -->
<div wire:ignore.self class="modal fade" id="createModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة منتج جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">باركود المنتج</label>
                        <input class="form-control" type="text" name="barcode" wire:model='barcode'>
                        @error('barcode')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المنتج</label>
                        <input class="form-control" type="text" name="name" wire:model='name' >
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">وصف المنتج</label>
                        <input class="form-control"type="text" name="description" wire:model='description'>
                        @error('description')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">كمية المنتج</label>
                        <input class="form-control" type="text" name="quantity" wire:model='quantity'>
                        @error('quantity')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">سعر تكلفة المنتج</label>
                        <input class="form-control" type="text" name="cost_price" wire:model='cost_price'>
                        @error('cost_price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">سعر بيع المنتج</label>
                        <input class="form-control" type="text" name="selling_price" wire:model='selling_price'>
                        @error('selling_price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">نسبة التخفيض</label>
                        <input class="form-control" type="text" name="discount" wire:model='discount'>
                        @error('discount')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group ">
                        <label class="main-content-label tx-12 tx-medium">أختر قسم المنتج</label>
                        <div class="input-group">
                            <select class="form-control" wire:model="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-append mx-1">
                                <a class="btn btn-primary text-white" data-target="#addCategoryModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        @error('category')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

                    </div>

                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أختر مورد المنتج</label>
                        <div class="input-group">
                            <select class="form-control" wire:model="supplier_id">
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-append mx-1">
                                <a class="btn btn-primary text-white" data-target="#addSupplierModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        @error('supplier')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

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
                <h6 class="modal-title">تعديل بيانات المنتج</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">باركود المنتج</label>
                        <input class="form-control" type="text" name="barcode" wire:model='barcode'>
                        @error('barcode')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المنتج</label>
                        <input class="form-control" type="text" name="name" wire:model='name' >
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">وصف المنتج</label>
                        <input class="form-control"type="text" name="description" wire:model='description'>
                        @error('description')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">كمية المنتج</label>
                        <input class="form-control" type="text" name="quantity" wire:model='quantity'>
                        @error('quantity')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">سعر تكلفة المنتج</label>
                        <input class="form-control" type="text" name="cost_price" wire:model='cost_price'>
                        @error('cost_price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">سعر بيع المنتج</label>
                        <input class="form-control" type="text" name="selling_price" wire:model='selling_price'>
                        @error('selling_price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">نسبة التخفيض</label>
                        <input class="form-control" type="text" name="discount" wire:model='discount'>
                        @error('discount')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group ">
                        <label class="main-content-label tx-12 tx-medium">أختر قسم المنتج</label>
                        <div class="input-group">
                            <select class="form-control" wire:model="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-append mx-1">
                                <a class="btn btn-primary text-white" data-target="#addCategoryModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        @error('category')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

                    </div>

                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أختر مورد المنتج</label>
                        <div class="input-group">
                            <select class="form-control" wire:model="supplier_id">
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            <span class="input-group-append mx-1">
                                <a class="btn btn-primary text-white" data-target="#addSupplierModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                        @error('supplier')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

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
                    <h6 class="modal-title">حذف المنتج</h6>
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
                        <label for="picture" class="d-block">صورة المنتج</label>

                        @if ( $picture !== NULL && method_exists($picture ,'temporaryUrl'))
                            <img src="{{ $picture->temporaryUrl() }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarLive">
                        @elseif($picture)
                            <img src="{{ URL::asset($picture) }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarData">
                        @elseif ($this->picture == NULL)
                            <img src="{{ URL::asset('mahrousa/public/uploads/product.jpg') }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="Avatar">
                        @endif

                        <input type="file" name="picture" class="form-control" wire:model='picture'>
                        @error('picture')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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

<!-- Barcode modal -->
<div wire:ignore.self class="modal fade" id="barcodeModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">باركود المنتج</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button" wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body my-5">
                {{-- <input class="form-control" type="text" name="barcode" wire:model='barcode' readonly> --}}
                <div class="" id="print">

                    <div  class="px-2" style="width: 100%;height: 53px;">
                        <div class="d-flex">
                            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG( $barcode, 'C39') }}" style="width: 100%;height: 50px;" salt="barcode" />
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="p-2">{{ $name }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" onclick="printDiv()">طباعة</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>

        </div>
    </div>
</div>
<!-- End Barcode modal -->

<!-- ِAdd Category modal -->
<div wire:ignore.self class="modal fade" id="addCategoryModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة قسم جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"  wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form"  enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم القسم</label>
                        <input class="form-control" type="text" name="nameCategory" wire:model='nameCategory'>
                        @error('nameCategory')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">وصف القسم</label>
                        <input class="form-control" type="text" name="descriptionCategory" wire:model='descriptionCategory'>
                        @error('descriptionCategory')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="storeCategory()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button"  wire:click="close()">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Category modal -->

<!-- ِAdd Supplier modal -->
<div wire:ignore.self class="modal fade" id="addSupplierModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة مورد جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"  wire:click="close()"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form"  enctype="multipart/form-data">

                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المورد</label>
                        <input class="form-control" type="text" name="nameSupplier" wire:model='nameSupplier'>
                        @error('nameSupplier')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="storeSupplier()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button"  wire:click="close()">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Supplier modal -->