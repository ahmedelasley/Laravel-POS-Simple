
<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="updateCustomerModal" >
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content modal-content-demo">
          <div class="modal-header">
              <h6 class="modal-title">تعديل بيانات العميل</h6>
              <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
              <form id="form" >
                <input type="hidden" name="id" wire:model='ids'>
                  <div class="form-group">
                      <label class="main-content-label tx-12 tx-medium">أسم العميل</label>
                      <input class="form-control" type="text" name="name" wire:model='name'>
                      @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                  </div>
                  <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" name="email" class="form-control" wire:model='email'>
                    @error('email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
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
              <button class="btn ripple btn-primary" type="button" wire:click.prevent="updateCustomer()">حفظ</button>
              <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
          </div>
      </div>
  </div>
</div>
<!-- End Basic modal -->




















{{-- <!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateCustomerModal" tabindex="-1" aria-labelledby="updateStudentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateStudentLabel">Edit Student</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="id" wire:model='ids'>

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" class="form-control" wire:model='name'>
              @error('name')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" class="form-control" wire:model='email'>
              @error('email')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" name="phone" class="form-control" wire:model='phone'>
              @error('phone')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
              <label for="address"><Address></Address></label>
              <input type="text" name="address" class="form-control" wire:model='address'>
              @error('address')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
            </div>
        </form>
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" wire:click.prevent='updateCustomer()'>Update Customer</button>
      </div>
    </div>
  </div>
</div> --}}