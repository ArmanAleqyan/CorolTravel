@extends('admin.layouts.default')
@section('title')
    Добавить Отел
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
                        <h4 class="card-title">Добавить Отел</h4>
                        <form id="myForm" action="{{route('create_hotel')}}" method="post" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group" bis_skin_checked="1">
                                <label class="btn btn-outline-warning" for="file">Выберете фотографии</label>
                                <input style="display: none"  type="file"  id="file" accept="image/*" multiple  >
                                <div id="imagePreview">
                                    <div id="newDivqwe"></div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleSelectGender">Страна</label>
                                <select style="color: white" name="country_id" class="form-control" id="exampleSelectGender">
                                    @foreach($get_country as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Имя  Отеля</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="name" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Вылет</label>
                                <input  style="color: #e2e8f0"  required type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" id="exampleInputName1"  name="start_date">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Кол-во ночей</label>
                                {{--                                <input  style="color: #e2e8f0"  required type="number" class="form-control" id="exampleInputName1"  name="night_count" value="">--}}
                                <select style="color: white" name="night_count" class="form-control" id="exampleSelectGender">
                                    @foreach($night_count as $night)
                                        <option value="{{$night}}">{{$night}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Цена</label>
                                <input  style="color: #e2e8f0"  required type="number" class="form-control" id="exampleInputName1"  name="price" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Цена с скидкой</label>
                                <input  style="color: #e2e8f0"   type="number" class="form-control" id="exampleInputName1"  name="new_price" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Текст 1</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="text_one" value="">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Текст 2</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="text_two" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Текст 3</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="text_three" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Текст 4</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="text_for" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Текст 5</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="text_five" value="">
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



                if (allLenght >0 ){
                    filteredArray.forEach(function(value, index) {
                        formData.append('photo[]', value);
                    });
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
                }else {
                    alert('Выберите фотографию')
                }





        });
    </script>
@endsection
