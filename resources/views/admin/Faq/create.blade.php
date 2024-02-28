@extends('admin.layouts.default')
@section('title')
    FAQ
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
                        <h4 class="card-title">FAQ</h4>
                        <form id="myForm" action="{{route('create_faq')}}" method="post" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Вопрос</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="question" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Ответ</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="replay" value="">
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

        //        $(document).ready(function() {
        //            $('#myForm').submit(function(event) {
        //                var photoInput = $('#file-logos');
        //                if (photoInput[0].files.length === 0) {
        //                    // File input is empty
        //                    alert('Выберете фотографию');
        //                    event.preventDefault(); // Prevent form submission
        //                }
        //            });
        //        });
        //



    </script>
@endsection
