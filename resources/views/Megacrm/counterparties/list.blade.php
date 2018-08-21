
@extends('Megacrm.layouts.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">Контрагенты</div>
                <div class="panel-body">
                    <p>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Название...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Найти</button>
                        </span>
                    </div>
                    </p>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-toolbar" role="toolbar" aria-label="...">
                            @for($i=1; $i < $CounterpartiesCount; $i++)
                                <button type="button" class="btn btn-default"><a href="{{ url('crm/counterparties/page\\/')}}{{$i}}">{{$i}}</a></button>
                            @endfor
                        </div>
                    </div>
                </div>


                <!-- Table -->
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Наименование</th>
                        <th>Телефон</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($Counterparties as $counterpart)
                        <tr id="{{$counterpart->id}}" class="counterparties">
                            <td>{{$i++}}</td>
                            <td>{{$counterpart->name}}</td>
                            <td>{{$counterpart->phone}}</td>
                        </tr>

                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
       $(".counterparties").click(function () {
           console.log($(this).attr('id'));
           location.href = "{{ url('crm/counterparties/card')}}" + "/" + $(this).attr('id');
       });
    });
</script>
@endsection