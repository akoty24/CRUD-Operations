@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{__('messages.Add your offer')}}

            </div>

            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <br>
            <form method="post" id="offerForm">
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name')}}</label>
                    <input type="text" class="form-control" name="name" placeholder="{{__('messages.Offer Name')}}">
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" name="price" placeholder="{{__('messages.Offer Price')}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">{{__('messages.Offer details')}}</label>
                    <input type="text" class="form-control" name="details"
                           placeholder="{{__('messages.Offer details')}}">
                    @error('details')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>


                <button type="submit" id="save_offer" class="btn btn-primary">{{__('messages.Save Offer')}}</button>
                <br>

                <a href="{{route('all offers')}}" class="btn btn-close-white">go to all offers</a>

            </form>


        </div>
    </div>
    </div>
@stop
@section('scripts')
    <script>

        $(document).on('click', '#save_offer', function (e) {
            e.preventDefault();


            const formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {

                    if (data.status === true) {
                        $('#success_msg').show();
                    }


                }, error: function (reject) {
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key, val) {
                        $("#" + key + "_error").text(val[0]);
                    });
                }
            });
        });


    </script>
@stop