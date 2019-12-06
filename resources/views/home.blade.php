@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh">
        <div class="col-md-8">
            <div class="card" id="profil">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <img class="rounded mb-4" style="max-width: 40%" style="" src="" alt="" srcset="">
                    <form action="" id="formAvatar">
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="avatar" id="avatar" placeholder="Avatar" aria-describedby="fileHelpId">
                        </div>
                        <input type="text" name="id" value="{{ Auth::user()->id }}" hidden>
                        <button type="submit">Upload</button>
                    </form>
                </div>
                <div class="card-body">
                </div>
                <div class="card-footer">
                    <a href="" id="modalEditAkun">Edit Akun</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                    <div class="col-md-6">
                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editAkun">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>

        // view
        $('nav').removeClass('fixed-top');
        $('main').addClass('py-4');

        // id user
        var idUser = "{{ Auth::user()->id }}";

        // show
        showUser(idUser)
        
        // show user
        function showUser(idUser) {
            $('#profil > .card-body').last().append('');

            $.ajax({
                type: "GET",
                url: "api/v1/user/"+idUser,
                success: function (response) {
                    $.map(response, function (val, key) {
                        $('#profil > .card-body').last().append(key);
                        $('#profil > .card-body').last().append('<h6>'+val+'</h6>');
                        $('#profil > .card-body').last().append('<hr/>');
                        if(key == 'avatar') {
                            console.log(val);
                            $('#profil').find('img').attr('src', 'images/'+val)
                        }
                    });
                }
            });
        }


        // edit akun
        $('#modalEditAkun').click(function (e) { 
            e.preventDefault();

            var modelEdit = $('#modelId').modal('show');

            $.ajax({
                type: "GET",
                url: "api/v1/user/"+idUser,
                success: function (response) {
                    $.each(response, function (key, value) { 
                        $(modelEdit).find('#'+key).val(value);
                    });
                }
            });
        });

        // update
        $('#modelId').find('#editAkun').click(function (e) { 
            e.preventDefault();
            var data = $('#modelId').find('form').serialize();

            $.ajax({
                type: "PUT",
                url: "api/v1/user/"+idUser,
                data: data,
                success: function (response) {
                    $('#modelId').modal('hide');
                    $('#modelId').trigger('reset');
                    $('#profil > .card-body').last().remove();
                    $('<div class="card-body"></div>').insertBefore('#profil > .card-footer');
                    showUser(response);
                }
            });
        });

        // image
        $('#formAvatar').submit(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('avatar.store') }}",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function (response) {
                    $('#profil > .card-body').last().remove();
                    $('<div class="card-body"></div>').insertBefore('#profil > .card-footer');
                    showUser(idUser);
                }
            });
        });
        
    </script>
@endpush