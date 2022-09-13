<!-- Basic modal -->
<div wire:ignore.self class="modal fade" id="changeLogoModel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تغيير شعار البرنامج</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
        <form id="form"  enctype="multipart/form-data" >
            <div class="modal-body">
                <input type="hidden" name="id" wire:model='ids'>
                <div class="form-group">
                    <div
                        x-data="{ isUploading: true, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = true"
                        x-on:livewire-upload-error="isUploading = true"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <label for="picture" class="d-block">صورة </label>

                        @if ( $picture !== NULL && method_exists($picture ,'temporaryUrl'))
                            <img src="{{ $picture->temporaryUrl() }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarLive">
                        @elseif($setting->picture)
                            <img src="{{ URL::asset($setting->picture) }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarData">
                        @elseif ($this->picture == NULL)
                            <img src="{{ URL::asset('uploads/logo.jpg') }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="Avatar">
                        @endif

                        <input type="file" name="picture" class="form-control" wire:model='picture'>
                        @error('picture')<span class="bg-danger tx-white d-block px-1 py-1">{{ $message }}</span>@enderror
                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <progress max="1" x-bind:value="progress"></progress>
                        </div>
                    </div>
                </div>


                    
                
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="changeLogo()" >حفظ</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">إغلاق</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- End Basic modal -->