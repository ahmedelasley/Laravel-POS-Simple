<div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

    
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
                        <label for="picture" class="d-block">الصورة الشخصية</label>

                        @if ( $picture !== NULL && method_exists($picture ,'temporaryUrl'))
                            <img src="{{ $picture->temporaryUrl() }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarLive">
                        @elseif($picture)
                            <img src="{{ URL::asset($picture) }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="AvatarData">
                        @elseif ($this->picture == NULL)
                            <img src="{{ URL::asset('mahrousa/public/uploads/person.jpg') }}" class="mx-auto my-1 img-thumbnail rounded h-70 w-70" alt="Avatar">
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
                <button class="btn ripple btn-primary" type="button" wire:click.prevent="updatePicture()" >تغيير</button>
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" wire:click="close()">إغلاق</button>
            </div>

        </div>
    </div>
</div>
<!-- End Picture modal -->

    <div class="card mg-b-20">
        <div class="card-body">
            <div class="pl-0">
                <div class="main-profile-overview">
                    <div class="main-img-user profile-user">
                    @if ($user->picture)
                        <img src="{{ URL::asset($user->picture) }}" class=""><a class="fas fa-camera profile-edit"data-toggle="modal" data-target="#pictureModel" wire:click.prevent='editPicture({{ $user->id }})'></a>
                    @else
                        <img src="{{ URL::asset('mahrousa/public/uploads/person.jpg') }}" class=""><a class="fas fa-camera profile-edit" data-toggle="modal" data-target="#pictureModel" wire:click.prevent='editPicture({{ $user->id }})'></a>
                    @endif
                    </div>
                    <div class="d-flex justify-content-between mg-b-20">
                        <div>
                            <h5 class="main-profile-name">{{ $user->name}}</h5>
                            <p class="main-profile-name-text">
                                @if (!empty($user->roles_name))
                                    @foreach ($user->roles_name as $key => $role)
                                    <label class="badge badge-primary">{{ $role }}</label>
                                    @endforeach
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-md-4 col mb20">
                            <h5>947</h5>
                            <h6 class="text-small text-muted mb-0">Followers</h6>
                        </div>
                        <div class="col-md-4 col mb20">
                            <h5>583</h5>
                            <h6 class="text-small text-muted mb-0">Tweets</h6>
                        </div>
                        <div class="col-md-4 col mb20">
                            <h5>48</h5>
                            <h6 class="text-small text-muted mb-0">Posts</h6>
                        </div>
                    </div> --}}
                    <hr class="mg-y-30">
                    <label class="main-content-label tx-13 mg-b-20">للأتصال</label>
                    <div class="main-profile-social-list">
                        <div class="media">
                            <div class="media-icon bg-primary-transparent text-primary">
                                <i class="icon ion-md-phone-portrait"></i>
                            </div>
                            <div class="media-body">
                                <span>Mobile</span>
                                <div>{{ $user->phone }}</div>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-icon bg-success-transparent text-success">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="media-body">
                                <span>Email</span>
                                <div>{{ $user->email }}</div>
                            </div>
                        </div>
                    </div>

                    
                </div><!-- main-profile-overview -->
            </div>
        </div>
    </div>
</div>