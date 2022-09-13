<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="addProductModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة منتج جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">باركود المنتج</label>
                        <input class="form-control" type="text" name="barcode" wire:model='barcode'>
                        @error('barcode')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المنتج</label>
                        <input class="form-control" type="text" name="name" wire:model='name'>
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">وصف المنتج</label>
                        <input class="form-control" type="text" name="description" wire:model='description'>
                        @error('description')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">تكلفة سعر المنتج</label>
                        <input class="form-control" type="text" name="cost_price" wire:model='cost_price'>
                        @error('cost_price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">سعر بيع المنتج</label>
                        <input class="form-control" type="text" name="selling_price" wire:model='selling_price'>
                        @error('selling_price')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">كمية المنتج</label>
                        <input class="form-control" type="text" name="quantity" wire:model='quantity'>
                        @error('quantity')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group ">
                        <label class="main-content-label tx-12 tx-medium">قسم المنتج</label>
                        <div class="input-group">
                            <select class="form-control" wire:model="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @can('أضافة قسم سريع')
                            <span class="input-group-append mx-1">
                                <a class="btn btn-primary text-white" data-target="#addCategoryModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                            </span>
                            @endcan
                        </div>
                        @error('category')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

                    </div>

                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">مورد المنتج</label>
                        <div class="input-group">
                            <select class="form-control" wire:model="supplier">
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                            @can('أضافة مورد سريع')
                            <span class="input-group-append mx-1">
                                <a class="btn btn-primary text-white" data-target="#addSupplierModel" data-toggle="modal"><i class="fa fa-plus"></i></a>
                            </span>
                            @endcan
                        </div>
                        @error('supplier')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror

                    </div>



                    <div class="form-group">
                        <div
                          x-data="{ isUploading: true, progress: 0 }"
                          x-on:livewire-upload-start="isUploading = true"
                          x-on:livewire-upload-finish="isUploading = true"
                          x-on:livewire-upload-error="isUploading = true"
                          x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >
                            <label for="picture">صورة المنتج</label>
                            @if ($picture)
                                <img src="{{ $picture->temporaryUrl() }}">
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
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="storeProduct()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->