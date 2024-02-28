@extends('admin.layouts.default')
@section('title')
    Инфо о нас
@endsection




@section('content')

    <div class="content-wrapper" bis_skin_checked="1">
        <br>
        <br>
        <br>
        <div class="row" bis_skin_checked="1">
            <div class="col-12 grid-margin stretch-card" bis_skin_checked="1">
                <div class="card" bis_skin_checked="1">
                    <div class="card-body" bis_skin_checked="1">
                        @if(session('created'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Добавление успешно завершено</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h4 class="card-title">Инфо о нас</h4>
                        <form id="myForm" action="{{route('update_info_o_nas')}}" method="post" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Instagram</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="instagram" value="{{$get->instagram}}">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Wk</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="wk" value="{{$get->wk}}">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Whatsapp</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="whatsapp" value="{{$get->whatsapp}}">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Telegram</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="telegram" value="{{$get->telegram}}">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="">Описание *</label>
                                <textarea style="height: 500px"  name="description_o_nas" id="myEditor">{{$get->description_o_nas}}</textarea>
                            </div>



                            <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>



        tinymce.init({
            selector: 'textarea',
            plugins: 'emoticons | textcolor | code undo redo | bold italic underline strikethrough | link image | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat',
            toolbar: 'emoticons | forecolor backcolor | code undo redo | formatselect | bold italic underline strikethrough | link image | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat',
            convert_urls: false,
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', url);
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function () {
                    try {
                        var json = JSON.parse(xhr.responseText);

                        if (json && typeof json.location === 'string') {
                            success(json.location);
                        } else {
                            failure('Invalid JSON: ' + xhr.responseText);
                        }
                    } catch (error) {
                        failure('Error parsing JSON: ' + error.message);
                    }
                };
                xhr.onerror = function () {
                    failure('Network error occurred');
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }
        });

    </script>
@endsection
