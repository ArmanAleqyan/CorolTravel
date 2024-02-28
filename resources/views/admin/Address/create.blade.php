@extends('admin.layouts.default')
@section('title')
    Контакты офисов
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
                        <h4 class="card-title">Контакты офисов</h4>
                        <form id="myForm" action="{{route('create_address')}}" method="post" class="forms-sample" enctype="multipart/form-data">
                            @csrf

                            <div bis_skin_checked="1">
                                <img style="object-fit: cover; object-position: center; max-height: 200px; max-width: 200px; width: 100%;" src="" alt="image" id="blahas">
                                <br>
                                <input accept="image/*" style="display: none" name="photo" id="file-logos" class="btn btn-outline-success" type="file">
                                <br>
                                <label style="width: 200px" for="file-logos" class="custom-file-upload btn btn-outline-success">
                                    Фотография
                                </label>
                            </div>
                            <br>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleSelectGender">Город</label>
                                <select style="color: white" name="city_id" class="form-control" id="exampleSelectGender">
                                    @foreach($work_city as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Адресс</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1" placeholder="Адресс" name="address" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Latitude</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="lat" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Longitude</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="long" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Метро</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1" placeholder="Метро" name="metro_name" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">WhatsApp</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="whatsapp" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Telegram</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="telegram" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Instagram</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="instagram" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Номер телефона</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="phone" value="">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Время Работы Пн-Пт</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="job_time" value="">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Время Работы Сб</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="job_time_saturday" value="">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Время Работы Вск</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="job_time_sunday" value="">
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
