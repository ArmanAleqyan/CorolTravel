@extends('admin.layouts.default')
@section('title')
    Редактировать Новость
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
                        <h4 class="card-title">Редактировать Новость</h4>
                        <form id="myForm" action="{{route('update_news')}}" method="post" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div bis_skin_checked="1">
                                <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="{{asset('uploads/'.$get->photo)}}" alt="image" id="blahas">
                                <br>
                                <input accept="image/*" style="display: none" name="photo" id="file-logos" class="btn btn-outline-success" type="file">
                                <br>
                                <label style="width: 200px" for="file-logos" class="custom-file-upload btn btn-outline-success">
                                    Фотография
                                </label>
                            </div>

                            <input type="hidden" name="news_id" value="{{$get->id}}">
                            <br>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Заголовок</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="title" value="{{$get->title}}">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Описание</label>
                                <textarea  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="description">{{$get->description}}</textarea>
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
