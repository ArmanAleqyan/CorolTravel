@extends('admin.layouts.default')
@section('title')
    Добавить Тур
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
                        <h4 class="card-title">Добавить Тур</h4>
                        <form id="myForm" action="{{route('create_tour')}}" method="post" class="forms-sample" enctype="multipart/form-data">
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
                                <label for="exampleInputName1">Название</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="title" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleSelectGender">Город Вылета</label>
                                <select style="color: white" name="vilet_city_id" class="form-control" id="exampleSelectGender">
                                    @foreach($get_vilet_city as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleSelectGender">Страна</label>
                                <select style="color: white" name="country_id" class="form-control" id="exampleSelectGender">
                                    @foreach($get_country as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Курорт</label>
                                <input  style="color: #e2e8f0"  required type="text" class="form-control" id="exampleInputName1"  name="kurort" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleSelectGender">Тип отдыха</label>
                                <select style="color: white" name="category_id" class="form-control" id="exampleSelectGender">
                                    @foreach($tour_category as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>




                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Дата Начала</label>
                                <input  style="color: #e2e8f0"  required type="date" max="9999-12-31" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" id="exampleInputName1"  name="date_start" value="">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Дата Завершерия</label>
                                <input  style="color: #e2e8f0"  required type="date" max="9999-12-31" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control" id="exampleInputName1"  name="date_end" value="">
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
                                <input  style="color: #e2e8f0"  required type="number" min="0" class="form-control" id="exampleInputName1"  name="price" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Цена с скидкой</label>
                                <input  style="color: #e2e8f0"   type="number" min="0" class="form-control" id="exampleInputName1"  name="new_price" value="">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Описание цены</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="price_description" value="*За человека при двухместном размещении">
                            </div>
                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">В цену входит</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="in_price_text" value="Авиаперелет, Проживание в отеле, Медицинская страховка, Трансфер">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Название Ресблика,Курорт,Остров ...</label>
                                <input  style="color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="republick_name" value="">
                            </div>

                            <div class="form-group" bis_skin_checked="1">
                                <label for="exampleInputName1">Описание</label>
                                <textarea  style="height:500px; color: #e2e8f0"   type="text" class="form-control" id="exampleInputName1"  name="republic_text" value=""></textarea>
                            </div>




                            <br>
                            <br>
                            <h3>Отели</h3>
                            <br>
                            <div id="editor-container"></div>
                            <div id="input-container" bis_skin_checked="1">
                            </div>
                            <button type="button" class="btn btn-inverse-light btn-fw" id="add-inputs">Добавить ещё</button>
                            <br><br>

                            <button type="submit" class="create_button  btn btn-inverse-success btn-fw">Сохранить</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('myForm').addEventListener('submit', function (event) {
                // Получаем элемент для загрузки фотографии
                var fileInput = document.getElementById('file-logos');

                // Проверяем, загружен ли файл
                if (fileInput.files.length === 0) {
                    // Если файл не загружен, показываем сообщение об ошибке
                    alert('Пожалуйста, загрузите фотографию');

                    // Отменяем отправку формы
                    event.preventDefault();
                }
            });
        });
    </script>
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
        const formDataArray = [];
        let i = 0;
        let bool = true;
        let DataArray = [];
        $(document).ready(function () {
            $("#add-inputs").click(function () {
                i++;
                const container = $(`
            <div class="form-group delete_inputs_div" bis_skin_checked="1" data_id="${i}" >

                <div style="display: flex; justify-content: space-between">


                </div>
                <br>
                <div style="display: flex; justify-content: space-between">
                    <label>Название</label>
                    <label>Цена</label>
                    <label>Цена со скидкой</label>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <input  required style="color: white;  width: 30%" name="data[${i}][name]" type="text" class="form-control data" id="exampleInputName1" placeholder="" >
                    <input required style="color: white; width: 30%" name="data[${i}][price]" type="number" min="0" class="form-control data" id="exampleInputName1" placeholder="" >
                    <input  style="color: white; width: 30%" name="data[${i}][new_price]" type="number" min="0" class="form-control data" id="exampleInputName1" placeholder="" >

                </div>
                    <br>

                <div id="new_inputs${i}">
                     <div class="form-group" bis_skin_checked="1">
                                <label class="btn btn-outline-warning" for="file${i}">Выберете фотографии</label>
                                <input style="display: none"  type="file"  id="file${i}" accept="image/*" multiple  >
                                <div id="imagePreview">
                                    <div style="    display: flex;
    gap: 25px;" class="newDivqwe" id="newDivqwe${i}"></div>
                                </div>
                            </div>
                            <br>
                    </div>

                <br>
<!--                   <button data_id="${i}" type="button" class="btn btn-inverse-light btn-fw addsub${i}" >Добавить поля</button>-->
                <br>
                <br>
                <div class="tinymce-editor-container">
                    <textarea id="tinymce_${i}" name="data[${i}][description]" class="tinymce-editor"></textarea>
                </div>
            </div>  <br><br> `);

                //////// Stexic dzer chtakl

                $("#input-container").append(container);

                //
                // function populateSelect(selectElement, optionArray) {
                //     selectElement.empty(); // Очищаем текущие option элементы в select
                //     optionArray.forEach(function (optionText, index) {
                //         const option = $('<option></option>');
                //         option.val(optionText); // Устанавливаем значение равное индексу в массиве
                //         option.text(optionText); // Устанавливаем текст option
                //         selectElement.append(option); // Добавляем option в select
                //     });
                // }

                 $(`#file${i}`).on('change keyup paste', function () {

                    let this_ = $(this);

                    DataArray[i] = [];
                    var numFiles = $(this)[0].files.length;

                    let allUndefined = DataArray;
                    let myArray = DataArray;
                    let filteredArray = myArray.filter(item => item !== undefined);
                    let allLenght = numFiles + filteredArray.length;


                    var file = $(this)[0].files.length;

                    let time =  $.now();
                    for (var is = 0; is < file; is++) {
                        let type = $(this)[0].files[is].type.split('/')[0]
                        DataArray[i].push($(this)[0].files[is]);

                        if (type == 'image') {
                            var fileUrl = URL.createObjectURL($(this)[0].files[is]);
                            $(this_).parent().find(`.newDivqwe`).append(`
                                    <div class="PhotoDiv${i}" style='overflow: visible;position: relative; width: 150px; height: 150px'>
                                        <button type="button"  class="ixsButton"   data-image-index="${is}" data-id="${i}" style='
                                            outline: none;
                                            border: none;
                                            position: relative;
                                            background-color: transparent;
                                        '></button>
                                        <img class='sendPhoto' style='width: 150px; height: 150px' src='${fileUrl}'/>
                                    </div>`);
                        } else {
                            $("#newDivqwe").append("  " +
                                "  <div class=\"PhotoDiv" + i + "\" style='overflow: visible;position: relative; width: 150px; height: 150px'>\n   " +
                                "                     <button class=\"ixsButton" + i + "\" data-id=" + (DataArray[i].length - 1) + " style='\n                                position: relative;\n                                    outline: none;\n                                    border: none;\n                                position: relative;\n                                '></button>" +
                                "<i class=\"fileType fa fa-file fa-3x\" aria-hidden=\"true\"> </i></div>")
                        }
                    }


                });
                tinymce.init({
                    height: "400px",
                    selector: `#tinymce_${i}`,
                    plugins: 'emoticons | code undo redo | bold italic underline strikethrough | link image | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat',
                    toolbar: 'emoticons | forecolor backcolor | code undo redo | formatselect | bold italic underline strikethrough | link image | alignleft aligncenter alignright | bullist numlist outdent indent | removeformat',
                    convert_urls: false,
                });
                // $(`.addsub${i}`).on("click", addSubHandler);
            });



            $("form").submit(function (event) {
                event.preventDefault();

                $(".delete_inputs_div").each(function () {
                    const name = $(this).find('[name^="data["][name$="[name]"]').val();

                    const price = $(this).find('[name^="data["][name$="[price]"]').val();
                    const new_price = $(this).find('[name^="data["][name$="[new_price]"]').val();

                    const id = $(this).find('[name^="data["][name$="[id]"]').val();


                    const description = JSON.stringify(
                        tinymce.get(`tinymce_${$(this).attr("data_id")}`).getContent()
                    );


                    formDataArray.push({
                        name: name,
                        price: price,
                        description: description,
                        id: id,
                        new_price: new_price,
                    });
                });
            });
        });

        $(document).on('click' , `.ixsButton`,function (event) {

            event.preventDefault()
            let index = $(this).attr('data-image-index')
            let data_id = $(this).attr('data-id')
            $(this).parent().hide()
            DataArray[data_id].splice(index,1,undefined)
            let data = DataArray[data_id];


            let allUndefined = true;
            $.each(data, function(index, item) {
                if (typeof item !== "undefined") {
                    allUndefined = false;
                    return false;
                }
            });
            // if (allUndefined) {
            //     $("#comment").removeAttr("disabled", 'disabled');
            //     $("#comment").css("display", 'block');
            // }
        })
        $(document).on('submit' , "#myForm",function (event) {
            event.preventDefault()
            $('.create_button').hide()

            const form = $(this)[0]; // Get the actual form element
            const formData = new FormData(form); // Create a FormData object

            formDataArray.forEach((value, index) => {
                formData.append(`datas[${index}]`, JSON.stringify(value));
            });

            DataArray.forEach((filesArray, outerIndex) => {
                filesArray.forEach((file, innerIndex) => {
                    formData.append(`photos[${outerIndex}][${innerIndex}]`, file);
                });
            });

            formDataArray.length = 0;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
                },
                url: "{{ route('create_tour') }}", // Обернул в кавычки
                type: 'POST',
                data: formData,
                processData: false, // Не обрабатываем данные
                contentType: false, // Не устанавливаем заголовок Content-Type
                success: function(response) {

                    alert('Тур добавлен');
                    window.location.href = response.url;
                },
                error: function(xhr, status, error) {
                    alert('Что то пошло не так свяжитес с разработчиком');
                    $('.create_button').show()
                }
            });
        })

    </script>


@endsection
