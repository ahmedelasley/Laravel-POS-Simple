<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="addSupplierModel" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أضافة مورد جديد</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <div class="form-group">
                        <label class="main-content-label tx-12 tx-medium">أسم المورد</label>
                        <input class="form-control" type="text" name="nameSupplier" wire:model='nameSupplier'>
                        @error('nameSupplier')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="storeSupplier()">حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- End Basic modal -->