
<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="changePictureCustomerModal" >
    <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل صورة العميل</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="form" enctype="multipart/form-data">
                        <input type="hidden" name="id" wire:model='ids'>

                        <div class="form-group">
                            <div x-data="{ isUploading: true, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = true"
                                x-on:livewire-upload-error="isUploading = true"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <label for="picture">صورة العميل</label>
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
                    <button class="btn ripple btn-primary" type="button" wire:click.prevent="changePictureCustomer()">حفظ</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
                </div>
            </div>
    </div>
</div>
<!-- End Basic modal -->

