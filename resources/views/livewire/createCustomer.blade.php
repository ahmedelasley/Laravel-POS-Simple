<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="addCustomerModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">إضافة عميل جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" >
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">إسم العميل</label>
                        <input class="form-control" type="text" name="name" wire:model='name'>
                        @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">هاتف العميل</label>
                        <input class="form-control"type="text" name="phone" wire:model='phone'>
                        @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">عنوان العميل</label>
                        <input class="form-control" type="text" name="address" wire:model='address'>
                        @error('address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="storeCustomer()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->