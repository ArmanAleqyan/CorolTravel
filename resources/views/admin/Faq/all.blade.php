@extends('admin.layouts.default')
@section('title')
    FAQ
@endsection

<style>
    table.dataTable.display tbody tr.even>.sorting_1, table.dataTable.order-column.stripe tbody tr.even>.sorting_1{
        background-color: #222222 !important;
    }
    table.dataTable.display tbody tr.odd>.sorting_1, table.dataTable.order-column.stripe tbody tr.odd>.sorting_1{
        background-color: #222222 !important;
    }
    table.dataTable.row-border tbody tr:first-child th, table.dataTable.row-border tbody tr:first-child td, table.dataTable.display tbody tr:first-child th, table.dataTable.display tbody tr:first-child td{
        background-color: #222222 !important;
    }
    .dataTables_wrapper {
        background-color: #000;
        color: #fff;
    }

    /* Стиль заголовка */
    #myTable th {
        background-color: #000;
        color: #fff;
    }

    /* Подсветка строк */
    #myTable tr.odd {
        background-color: #111;
    }

    #myTable tr.even {
        background-color: #222;
    }

    /* Стиль выделенных строк */
    #myTable tr.selected {
        background-color: #333;
    }

    /* Стиль для пагинации */
    #myTable_paginate {
        color: #fff;
    }

    /* Стиль для поиска */
    #myTable_filter input[type="search"] {
        background-color: #444;
        color: #fff;
        border: 1px solid #333;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        color: #e2e8f0 !important;
    }
    div.dataTables_wrapper div.dataTables_filter label{
        color: #e2e8f0 !important;
    }
    table.display tbody tr:nth-child(even):hover td{
        background-color: transparent !important;
    }

    table.display tbody tr:nth-child(odd):hover td {
        background-color: transparent !important;
    }
</style>

@section('content')
    <div class="main-panel" bis_skin_checked="1">
        <div class="content-wrapper" bis_skin_checked="1">

            <div class="row " bis_skin_checked="1">
                <div class="col-12 grid-margin" bis_skin_checked="1">
                    <div class="card" bis_skin_checked="1">
                        <div class="card-body" bis_skin_checked="1">
                            <div style="display: flex; justify-content: space-between">
                                <h4 class="card-title"> FAQ</h4>
                                <div>
                                    <a href="{{route('create_faq_page')}}" class="btn btn-inverse-warning btn-fw">Добавить</a>
                                </div>
                            </div>
                            <div class="table-responsive" bis_skin_checked="1">
                                <table id="myTable" class="display">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Вопрос</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($get as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->question}}</td>
                                            <td style="    width: 10px;"><a href="{{route('single_page_faq', $item->id)}}" class="btn btn-inverse-warning btn-fw">Редактирование</a> </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('#myTable').DataTable({
                "theme": "black"
            });
        });
    </script>
@endsection
