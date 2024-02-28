@extends('admin.layouts.default')
@section('title')
    Редактировать  Отел
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
                        @php
                            $get_hotel_relation_tour = App\Models\TourHotels::where('hotel_id', $get->id)->first();
                        @endphp
                        <div style="display: flex; justify-content: space-between">
                        <h4 class="card-title">Редактировать  Отел</h4>
                            <a class="btn btn-inverse-warning btn-fw" href="{{route('single_page_tour',$get_hotel_relation_tour->tour_id)}}">Назад</a>
                        </div>
                        <form id="myForm" action="{{route('update_hotel')}}" method="post" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" bis_skin_checked="1">
                                <label class="btn btn-outline-warning" for="file">Выберете фотографии</label>
                                <input style="display: none"  type="file"  id="file" accept="image/*" multiple  >
                                <div id="imagePreview">
                                    <div id="newDivqwe">

                                        @foreach($get->photo as $photo)
                                            <div class="PhotoDiv" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                                                @if($get->photo->count() > 1)
                                                    <button type="button"  class="ixsButton delete_photo" data_url="{{route('delete_hotel_photo', $photo->id)}}" data-id="{{$photo->id}}" style='
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                '></button>
                                                @endif
                                                <img class='sendPhoto' style='width: 150px; height: 150px' src='{{asset('uploads/'.$photo->photo)}}'/>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <br>
{{--                            <div class="form-group" bis_skin_checked="1">--}}
{{--                                <label for="exampleSelectGender">Страна</label>--}}
{{--                                <select style="color: white" name="country_id" class="form-control" id="exampleSelectGender">--}}
{{--                                    @foreach($get_country as $country)--}}
{{--                                        @if($country->id == $get->country_id)--}}
{{--                                        <option value="{{$country->id}}" selected>{{$country->name}}</option>--}}
{{--                                        @else--}}
{{--                                        <option value="{{$country->id}}" >{{$country->name}}</option>--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Имя  Отеля</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="name" value="{{$get->name}}">
                            </div>
{{--                            <div class="form-group" bis_skin_checked="1">--}}
{{--                                <label for="exampleInputName1">Вылет</label>--}}
{{--                                <input  style="color: #e2e8f0" value="{{$get->start_date}}"  required type="date" min="{{$get->start_date}}" class="form-control" id="exampleInputName1"  name="start_date">--}}
{{--                            </div>--}}
{{--                            <div class="form-group" bis_skin_checked="1">--}}
{{--                                <label for="exampleInputName1">Кол-во ночей</label>--}}
{{--                                --}}{{--                                <input  style="color: #e2e8f0"  required type="number" class="form-control" id="exampleInputName1"  name="night_count" value="">--}}
{{--                                <select style="color: white" name="night_count" class="form-control" id="exampleSelectGender">--}}
{{--                                    @foreach($night_count as $night)--}}
{{--                                        @if($get->night_count == $night)--}}
{{--                                        <option value="{{$night}}" selected>{{$night}}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="{{$night}}" >{{$night}}</option>--}}
{{--                                            @endif--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <input type="hidden" name="hotel_id" value="{{$get->id}}">
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Цена</label>
                                <input  style="color: #e2e8f0"  required type="number" class="form-control" id="exampleInputName1"  name="price" value="{{$get->price}}">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Цена с скидкой</label>
                                <input  style="color: #e2e8f0"   type="number" class="form-control" id="exampleInputName1"  name="new_price" value="{{$get->new_price}}">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Описание</label>
                                <textarea  style="height: 500px; color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="description" value="">{{$get->description}}</textarea>
                            </div>
                            <div style="display: flex; justify-content: space-between">
                            <button type="submit" class="btn btn-inverse-success btn-fw">Сохранить</button>
                            <a href="{{route('delete_hotel', $get->id)}}" class="btn btn-inverse-danger btn-fw">Удалить</a>
                            </div>
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
            plugins: 'emoticons | code undo redo | bold italic underline strikethrough | link image | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat',
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
    <script>
        $(document).ready(function() {
            $('.delete_photo').click(function() {
                var photoId = $(this).data('id');
                var photoUrl = $(this).attr('data_url');
                var confirmDelete = confirm('Вы действительно хотите удалить фотографию?');

                if (confirmDelete) {
                    window.location.href = photoUrl;
                }
            });
        });
        let DataArray = [];
        $(document).ready(function () {
            $("#file").on('change keyup paste', function () {

                var numFiles = $('input[type="file"]')[0].files.length;
                let allUndefined = DataArray;
                let myArray = DataArray;
                let filteredArray = myArray.filter(item => item !== undefined);
                let allLenght = numFiles + filteredArray.length;

                $("#comment").attr("disabled", 'disabled');
                $("#comment").css("display", 'none');

                var file = $('input[type="file"]')[0].files.length;
                let time =  $.now();
                for (var i = 0; i < file; i++) {
                    let type = $("input[type='file']")[0].files[i].type.split('/')[0]
                    DataArray.push($("input[type='file']")[0].files[i]);

                    if (type == 'image') {
                        var fileUrl = URL.createObjectURL($("input[type='file']")[0].files[i]);
                        $("#newDivqwe").append(`
                        <div class="PhotoDiv" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                        <button  class="ixsButton" data-id="${DataArray.length-1}" style='
                                    outline: none;
                                    border: none;
                                position: relative;
                                background-color: transparent;
                                '></button>
                        <img class='sendPhoto' style='width: 150px; height: 150px' src='${fileUrl}'/>
                        </div>`);
                    } else {
                        $("#newDivqwe").append("  " +
                            "" +
                            "  <div class='PhotoDiv' style='overflow: visible;position: relative; width: 150px; height: 150px'>\n   " +
                            "                     <button class=\"ixsButton\" data-id="+`${DataArray.length-1}`+" style='\n                                position: relative;\n                                    outline: none;\n                                    border: none;\n                                position: relative;\n                                '></button>" +
                            "<i class=\"fileType fa fa-file fa-3x\" aria-hidden=\"true\"> </i></div>")
                    }
                }
                $(".ixsButton").click(function (event) {
                    event.preventDefault()
                    let data_id = $(this).attr('data-id')
                    $(this).parent('.PhotoDiv').hide()
                    DataArray.splice(data_id,1,undefined)
                    let data = DataArray;


                    let allUndefined = true;
                    $.each(data, function(index, item) {
                        if (typeof item !== "undefined") {
                            allUndefined = false;
                            return false;
                        }
                    });
                    if (allUndefined) {
                        $("#comment").removeAttr("disabled", 'disabled');
                        $("#comment").css("display", 'block');
                    }
                })

            });
        });


        $('#myForm').on('submit',function(e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = new FormData(this);
            let filteredArray = DataArray.filter(item => item !== undefined);
            let allLenght = filteredArray.length;



            if (allLenght >0 ) {
                filteredArray.forEach(function (value, index) {
                    formData.append('photo[]', value);
                });
            }
                var token = $('meta[name="_token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $('.submit_button').hide();
                $('.lds-ellipsis').show();
                $.ajax({
                    url:  $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('ress--------------',response)
                        alert('Добавления успешно завершено');
                        window.location.replace(response.url);
                    },
                    error: function(xhr, status, error) {
                        $('.lds-ellipsis').hide();
                        $('.submit_button').show();
                        alert('Что то пошло не так свяжитесь с разработчиком')


                    }
                });






        });
    </script>
@endsection
