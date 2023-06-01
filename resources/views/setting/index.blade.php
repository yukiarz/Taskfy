@extends('base.foundation')

@section('title','Projects')

@section('meta')


@endsection


@section('css')


@endsection

@section('content')
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Profile</h5>
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{asset('launch/img/avatar/cat.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">Upload new photo</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" id="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">❗ Please upload a square shaped image</p>
                    </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <form id="formAccountSettings" action="{{route('setting.store')}}" method="POST" onsubmit="return false">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">Name</label>
                            <input class="form-control" type="text" name="firstName" value="{{$setting->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" name="email" value="{{$setting->name}}" >
                        </div>
                        <div class="mb-3">
                            <label for="organization" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="organization" value="{{$setting->userSetting->phone}}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Posisition</label>
                            <input type="text" class="form-control" name="posisition" value="{{$setting->userSetting->position}}">
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                    </form>
                </div>
        <!-- /Account -->
            </div>
        </div>
        <div class="col-md-2"></div>

    </div>
@endsection

@push('script')
<script src="{{asset('launch/js/pages-account-settings-account.js')}}"></script>

@endpush

