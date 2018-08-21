
@extends('Megacrm.layouts.main')

@section('content')


    <div class="container">
        <div class="panel  panel-primary">
            <div class="panel-heading">Управление группами</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4">
                        <select name="groups" id="groups" size="1" style="width: 200px">
                            <option selected="" value="0">Выберете группу</option>
                            @foreach ($Groups as $group)
                                <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4"><select size="10" name="user_in_group" id="user_in_group"><option size="10" value="0">Выберете пользователя</option></select></div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>
                                    <button class="btn btn-primary" data-toggle="modal" onclick="add_user_group()">
                                        Добавить пользователя
                                    </button>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p>
                                    <button class="btn btn-danger" id="del_user_to_group">
                                        Удалить пользователя
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script type="text/javascript">
        function add_user_group() {


            $("#dialog").dialog("open");
            $("#dialog").html("<img src=\"image/loader.gif\">");

            $("#dialog").html("" +
                "<div class=\"row\"><div class=\"col-sm-12\">Пользователи</div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\" id=\"status_save\"></div></div>" +
                "<div class=\"row\"><div class=\"col-sm-4\"><input type=\"text\" name=\"name_search_to_report\" placeholder=\"Фамилия\"></div><div class=\"col-sm-4\"></div><div class=\"col-sm-4\"><div class=\"btn btn-primary\" id=\"search_user\">Найти</div> </div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\"><select size=\"1\" style=\"width:170px\" class=\"form-control\" name=\"user_list_report\" id=\"user_list_report\"></select></div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\">" +
                "<div class=\"btn btn-primary\" id=\"save_user_to_report\">Добавить</div>" +
                "</div></div>" +
                "");



            $("#search_user").click(function () {
                var name = $("input[name='name_search_to_report']").val();

                console.log(name);

                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin/managegroup/searchUser/') }}",
                    data: "name=" + name + "&_token=" + "{{ csrf_token() }}",
                    success: function (msg) {
                        $("#user_list_report").html("");
                        var data = msg;
                        $.each(data, function (key, value) {
                            var name = value.name + " " + value.last_name;
                            $("#user_list_report").append("<option value=\"" + value.id + "\">" + name + "</option>");
                        });


                    }
                });

            });

            $("#groups").change(function(){
                console.log($(this).val());
            });

            $("#save_user_to_report").click(function () {
                var user_list_report = $("#user_list_report option:selected").val();
                var groups = $("#groups").val();

                console.log(user_list_report);
                console.log(groups);

                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin/managegroup/addUserToGroup/') }}",
                    data: "users=" + user_list_report + "&group=" + groups + "&_token=" + "{{ csrf_token() }}",
                    success: function (msg) {
                        $("#user_in_group").html("");
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/admin/managegroup/getUserInGroup/') }}",
                            data: "id=" + groups + "&_token=" + "{{ csrf_token() }}",
                            success: function (msg) {
                                var i = 0;
                                $.each(msg, function (key, value) {
                                    $("#user_in_group").append("<option value=\"" + value.id + "\">" + value.name + "</option>");
                                });
                            }
                        });
                    }
                });

                // $.ajax({
                //     type: "POST",
                //     url: "scripts/add_users_to_group.php",
                //     data: "id=" + user_list_report + "&group=" + groups,
                //     success: function (msg) {
                //         $("#list_user").html("");
                //
                //         if (msg == "error") {
                //             $("#status_save").text("Ошибка");
                //         } else {
                //             $("#status_save").text("Сохранено");
                //             $.ajax({
                //                 type: "POST",
                //                 url: "scripts/reports/get_user_report.php",
                //                 data: "group=" + msg,
                //                 success: function (msg) {
                //                     var data = $.parseJSON(msg);
                //
                //
                //                     var name = "";
                //                     $.each(data, function (key, value) {
                //                         BX24.callMethod('user.get', {"ID": value.id_user},
                //                             function(result)
                //                             {
                //                                 if(result.error())
                //                                     console.error(result.error());
                //                                 else
                //                                 {
                //                                     console.dir(result.data());
                //                                     name = result.data()[0].NAME + " " + result.data()[0].LAST_NAME;
                //                                     console.log(name);
                //                                     $("#list_user").append("<a href=\"#\" class=\"list-group-item list-group-item-action user_list\" id=\"user_" + value.id_user + "\" onclick=\"load_report_user('" + value.id_user + "')\">" + name + "</a>");
                //                                     if(result.more())
                //                                         result.next();
                //                                 }
                //                             });
                //
                //
                //                     });
                //                 }
                //             });
                //         }
                //     }
                // });
            });

        }

        $(document).ready(function () {

            $("#groups").change(function(){
                $("#users_in_group").html("<select size=\"10\"  name=\"user_in_group\" id=\"user_in_group\"><option  size=\"10\" value=\"0\">Выберете пользователя</option>");
                $("#user_in_group").change(function(){
                    console.log($(this).val());
                    user_id_to_remove = $(this).val();
                });
                var i = 0;
                if($(this).val() == 0) return false;
                change_group = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin/managegroup/getUserInGroup/') }}",
                    data: "id=" + change_group + "&_token=" + "{{ csrf_token() }}",
                    success: function (msg) {

                        $("#user_in_group").html("");
                        $.each(msg, function (key, value) {
                            $("#user_in_group").append("<option value=\"" + value.id + "\">" + value.name + "</option>");
                        });

                    }
                });
            });

            $("#add_user_to_group").click(function () {
                $("#model_show_fields_3").html("<img src=\"image/loader.gif\">");
                $("#model_show_fields_3").html("<select size=\"25\" multiple name=\"add_users\" id=\"add_users\">");
                $("#add_users").change(function() {
                    change_user_add = $( this ).val();
                });

                BX24.callMethod(
                    "user.get",
                    {
                        order: { "LAST_NAME": "ASC" }
                    },
                    function(result)
                    {
                        if(result.error())
                            console.error(result.error());
                        else
                        {
                            console.dir(result.data());
                            for (u=0; u<result.data().length; u++) {
                                var name = result.data()[u].NAME + " " + result.data()[u].LAST_NAME;

                                console.log(result.data()[u]);
                                console.log(name);

                                $("#add_users").append("<option value=\"" + result.data()[u].ID + "\">" + name + "</option>");


                            }

                            if(result.more())
                                result.next();
                        }
                    }
                );

            });
            $("#add_users_btn").click(function(){
                console.log(change_user_add + " " + change_group);
                $.ajax({
                    type: "POST",
                    url: "{{ url('/admin/managegroup/addUserToGroup/') }}",
                    data: "users=" + change_user_add + "&group=" + change_group + "&_token=" + "{{ csrf_token() }}",
                    success: function (msg) {
                        $("#user_in_group").html("");
                        $.ajax({
                            type: "POST",
                            url: "{{ url('/admin/managegroup/getUserInGroup/') }}",
                            data: "id=" + groups + "&_token=" + "{{ csrf_token() }}",
                            success: function (msg) {

                                $.each(msg, function (key, value) {
                                    $("#user_in_group").append("<option value=\"" + value.id + "\">" + value.name + "</option>");
                                });

                            }
                        });
                    }
                });
            });

            $("#add_group_btn").click(function(){
                var group_name = $("input[name='name_group']").val();
                var desc_group = $("input[name='desc_group']").val();

                console.log(group_name + " " + desc_group);
                $.ajax({
                    type: "POST",
                    url: "scripts/add_group.php",
                    data: "group_name=" + group_name + "&desc_group=" + desc_group,
                    success: function (msg) {

                    }
                });
            });
            $("#del_user_to_group").click(function () {

                $.ajax({
                    type: "POST",
                    url: "scripts/delete_user_from_group.php",
                    data: "id=" + user_id_to_remove + "&group=" + change_group,
                    success: function (msg) {
                        $("#user_in_group").html("");

                        $.ajax({
                            type: "POST",
                            url: "scripts/get_user_in_group.php",
                            data: "id=" + change_group,
                            success: function (msg) {
                                var i = 0;
                                console.log($.parseJSON(msg));
                                $.each($.parseJSON(msg), function (key, value) {

                                    BX24.callMethod('user.get', {"ID": value.id_user},
                                        function(result)
                                        {
                                            if(result.error())
                                                console.error(result.error());
                                            else {
                                                console.dir(result.data());
                                                var name = result.data()[0].NAME + " " + result.data()[0].LAST_NAME;
                                                console.log(key + " " + name);

                                                $("#user_in_group").append("<option value=\"" + result.data()[0].ID + "\">" + name + "</option>");

                                                if(result.more())
                                                    result.next();
                                            }
                                        });
                                    i++;
                                    console.log($.parseJSON(msg).length + " >>>> " + i);
                                    if ($.parseJSON(msg).length == i) {
                                        access_value += "</select>";
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>


@endsection