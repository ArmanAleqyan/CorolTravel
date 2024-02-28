@extends('admin.layouts.default')
@section('title')
    Пользователи
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
                                <strong>Редактирование успешно завершено</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h4 class="card-title">Редактировать Пользователя</h4>
                        <form id="myForm" action="{{route('update_tour_operator')}}" method="post" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Имя</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="name" value="{{$get->name }}">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Email</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="email" value="{{$get->email }}">
                                @if($errors->has('email'))
                                    <span class="text-danger">Такая Эл.почта уже сушествует</span>
                                @endif
                            </div>

                            <input type="hidden" name="operator_id" value="{{$get->id}}">

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Пароль</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="password" value="">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleSelectGender">Офис</label>
                                <select style="color: white" name="address_id" class="form-control" id="exampleSelectGender">
                                    @foreach($get_work_address as $city)
                                        @if( $city->id == $get->city_id)
                                            <option selected value="{{$city->id}}">{{$city->city->name}}-{{$city->address}}</option>
                                        @else
                                            <option value="{{$city->id}}">{{$city->city->name}}-{{$city->address}}</option>
                                        @endif
                                    @endforeach

                                </select>
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
