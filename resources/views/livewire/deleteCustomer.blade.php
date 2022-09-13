
<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="deleteCustomerModal" >
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content modal-content-demo">
          <div class="modal-header">
              <h6 class="modal-title">هل تريد حذف العميل</h6>
              <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form" >
                <input type="hidden" name="id" wire:model='ids'>
                  <div class="form-group">
                      <input class="form-control tx-20" type="text" name="name" wire:model='name' readonly>
                  </div>
              </form>
          </div>
          <div class="modal-footer">
              <button class="btn ripple btn-primary" type="button" wire:click.prevent="removeCustomer()">نعم</button>
              <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
          </div>
      </div>
  </div>
</div>
<!-- End Basic modal -->

