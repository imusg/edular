@extends('Megacrm.layouts.main')

@section('content')


    <div class="container">
        <div class="panel  panel-primary">
            <div class="panel-heading">Админиcтрирование</div>
            <div class="panel-body">
                <div class="row" style="margin-left: 20px">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <h4>Добавить администратора</h4>
                            </div>
                        </div>
                        <form id="contactform" method="POST" class="validateform">
                        <div class="row">
                            <div class="col-12">

                                <select name="newAdmin" id="newAdmin" size="1" style="width: 250px">
                                    @foreach ($Users as $user)
                                        <option id="newAdmin" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-12">
                                <div class="btn btn-primary" id="addAdmin">Добавить</div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-6"></div>
                </div>
            </div>
        </div>


    </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#addAdmin").click(function () {
            var newAdmin = $("#newAdmin").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/addAdmin') }}",
                data: $('#contactform').serialize(),
                success: function(result){
                    if (result == "OK") {
                        alert("Админ добавлен");
                    } else if (result == "exist") {
                        alert("Админ уже добавлен");
                    }
                }
            });
        });



    });
</script>
@endsection