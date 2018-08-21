@extends('Megacrm.layouts.main')

@section('content')


    <div class="container">
        <div class="panel  panel-primary">
            <div class="panel-heading">Управление отчетами</div>
            <div class="panel-body">
                <div class="row"><div class="col-12"><h4>Права пользователей</h4></div> </div>
                <div class="row" style="margin-left: 20px">
                    <div class="col-sm-6 MyScroll">
                        <div class="list-group">
                            @foreach ($Users as $user)
                                <a href="#" class="list-group-item list-group-item-action user_list" id="user_{{ $user->id }}" onclick="load_report_user('{{ $user->id }}')" value="{{ $user->id }}">{{ $user->name }}</a>
                            @endforeach
                        </div>

                    </div>
                    <div class="col-sm-6 MyScroll" id="list_reports_user">
                        @foreach ($Reports as $report)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="check_report_user" value="{{ $report->id }}" id="exampleRadios1">
                                <label class="form-check-label" for="exampleRadios2">{{ $report->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row"><div class="col-12"><div class="btn btn-primary" id="save_user_reports">Сохранить</div> </div> </div>


                <div class="row"><div class="col-sm-12"><h4>Права групп</h4></div> </div>
                <div class="row" style="margin-left: 20px">
                    <div class="col-sm-6 MyScroll">
                        <div class="list-group">
                            @foreach ($Groups as $group)
                                <a href="#" class="list-group-item list-group-item-action group_list" id="group_{{ $group->id }}" onclick="load_report_group('{{ $group->id }}')" value="{{ $group->id }}">{{ $group->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6 MyScroll" id="list_reports">
                        @foreach ($Reports as $report)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="check_report_group" value="{{ $report->id }}" id="exampleRadios1">
                                <label class="form-check-label" for="exampleRadios2">{{ $report->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row"><div class="col-12"><div class="btn btn-primary" id="save_group_reports">Сохранить</div> </div> </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function load_report_group(id) {
            check_group = id;
            $(".group_list").removeClass("active");
            $("#group_" + id).addClass("active");
            $("#list_reports").html("");
            $.ajax({
                type: "POST",
                url: "{{ url('/admin/managereport/getReportGroup/') }}" + id,
                data: "_token=" + "{{ csrf_token() }}",
                success: function (msg) {
                    console.log(msg);
                    var data = msg;
                    console.log(data);
                    $.each(data, function (key, value) {

                        if (value.checked) {

                            $("#list_reports").append("<div class=\"form-check\">" +
                                "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_group\" value=\"" + value.report_id + "\" id=\"exampleRadios1\" checked>" +
                                "  <label class=\"form-check-label\" for=\"exampleRadios1\">" + value.name + "  </label>" +
                                "</div>");
                        } else {

                            $("#list_reports").append("<div class=\"form-check\">" +
                                "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_group\" value=\"" + value.report_id + "\" id=\"exampleRadios1\">" +
                                "  <label class=\"form-check-label\" for=\"exampleRadios1\">" + value.name + "  </label>" +
                                "</div>");
                        }



                    });


                }
            });
        }
        function load_report_user(id) {
            check_user = id;
            $(".user_list").removeClass("active");
            $("#user_" + id).addClass("active");
            $("#list_reports_user").html("");
            $.ajax({
                type: "POST",
                url: "{{ url('/admin/managereport/getReportUser/') }}" + id,
                data: "_token=" + "{{ csrf_token() }}",
                success: function (msg) {
                    console.log(msg);
                    var data = msg;
                    console.log(data);

                    $.each(data, function (key, value) {
                        $("#list_reports").html("");

                        if (value.checked) {
                            $("#list_reports_user").append("<div class=\"form-check\">" +
                                "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_user\" value=\"" + value.report_id + "\" id=\"exampleRadios2\" checked>" +
                                "  <label class=\"form-check-label\" for=\"exampleRadios2\">" + value.name + "  </label>" +
                                "</div>");
                        } else {
                            $("#list_reports_user").append("<div class=\"form-check\">" +
                                "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_user\" value=\"" + value.report_id + "\" id=\"exampleRadios2\">" +
                                "  <label class=\"form-check-label\" for=\"exampleRadios2\">" + value.name + "  </label>" +
                                "</div>");
                        }



                    });

                }
            });
        }

        function add_group_report() {
            $("#exampleModal_10").modal("show");


            $("#model_show_fields_10").html("<img src=\"image/loader.gif\">");


            $("#model_show_fields_10").html("" +
                "<div class=\"row\"><div class=\"col-sm-12\">Группы</div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\" id=\"status_save\"></div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\"><select size=\"1\" style=\"width:170px\" class=\"form-control\" name=\"group_list_report\" id=\"group_list_report\"></select></div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\">" +
                "<div class=\"btn btn-primary\" id=\"save_group_to_report\">Добавить</div>" +
                "</div></div>" +
                "");

            $.ajax({
                type: "POST",
                url: "scripts/get_group.php",
                success: function (msg) {
                    var data = $.parseJSON(msg);

                    $.each(data, function (key, value) {
                        $("#group_list_report").append("<option value=\"" + value.id + "\">" + value.name + "</option>");
                    });
                }
            });

            $("#save_group_to_report").click(function () {
                var group_list_report = $("#group_list_report option:selected").val();

                $.ajax({
                    type: "POST",
                    url: "scripts/reports/add_group_report.php",
                    data: "id=" + group_list_report,
                    success: function (msg) {
                        if (msg == "error") {
                            $("#status_save").text("Ошибка");
                        } else {
                            $("#status_save").text("Сохранено");
                            $.ajax({
                                type: "POST",
                                url: "scripts/reports/get_group_report.php",
                                success: function (msg) {
                                    var data = $.parseJSON(msg);
                                    $("#list_group").html("");
                                    $.each(data, function (key, value) {
                                        $("#list_group").append("<a href=\"#\" class=\"list-group-item list-group-item-action group_list\" id=\"group_" + value.id_group + "\" onclick=\"load_report_group('" + value.id_group + "')\">" + value.name + "</a>");
                                    });
                                }
                            });
                        }
                    }
                });
            });
        }
        function add_user_report() {
            $("#exampleModal_9").modal("show");


            $("#model_show_fields_9").html("<img src=\"image/loader.gif\">");

            $("#model_show_fields_9").html("" +
                "<div class=\"row\"><div class=\"col-sm-12\">Пользователи</div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\" id=\"status_save\"></div></div>" +
                "<div class=\"row\"><div class=\"col-sm-4\"><input type=\"text\" name=\"name_search_to_report\" placeholder=\"Имя\"></div><div class=\"col-sm-4\"></div><div class=\"col-sm-4\"><div class=\"btn btn-primary\" id=\"search_user\">Найти</div> </div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\"><select size=\"1\" style=\"width:170px\" class=\"form-control\" name=\"user_list_report\" id=\"user_list_report\"></select></div></div>" +
                "<div class=\"row\"><div class=\"col-sm-12\">" +
                "<div class=\"btn btn-primary\" id=\"save_user_to_report\">Добавить</div>" +
                "</div></div>" +
                "");

            $("#search_user").click(function () {
                var name = $("input[name='name_search_to_report']").val();

                console.log(name);

                BX24.callMethod('user.get', {"NAME": name},
                    function(result)
                    {
                        if(result.error())
                            console.error(result.error());
                        else
                        {
                            $("#user_list_report").html("");

                            console.log(result.more());
                            console.log(result.next());

                            var data = result.data();

                            $.each(data, function (key, value) {
                                var name = value.NAME + " " + value.LAST_NAME;
                                $("#user_list_report").append("<option value=\"" + value.ID + "\">" + name + "</option>");
                            });




                            result.next();
                            if(!result.more()) {

                            }
                        }
                    });
            });

            $("#save_user_to_report").click(function () {
                var user_list_report = $("#user_list_report option:selected").val();

                $.ajax({
                    type: "POST",
                    url: "scripts/reports/add_user_report.php",
                    data: "id=" + user_list_report,
                    success: function (msg) {
                        $("#list_user").html("");

                        if (msg == "error") {
                            $("#status_save").text("Ошибка");
                        } else {
                            $("#status_save").text("Сохранено");
                            $.ajax({
                                type: "POST",
                                url: "scripts/reports/get_user_report.php",
                                success: function (msg) {
                                    var data = $.parseJSON(msg);

                                    var name = "";
                                    $.each(data, function (key, value) {
                                        BX24.callMethod('user.get', {"ID": value.id_user},
                                            function(result)
                                            {
                                                if(result.error())
                                                    console.error(result.error());
                                                else
                                                {
                                                    console.dir(result.data());
                                                    name = result.data()[0].NAME + " " + result.data()[0].LAST_NAME;
                                                    console.log(name);
                                                    $("#list_user").append("<a href=\"#\" class=\"list-group-item list-group-item-action user_list\" id=\"user_" + value.id_user + "\" onclick=\"load_report_user('" + value.id_user + "')\">" + name + "</a>");
                                                    if(result.more())
                                                        result.next();
                                                }
                                            });
                                    });
                                }
                            });
                        }
                    }
                });
            });

        }



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
            $("#save_group_reports").click(function () {
                var check_report = {};
                i=0;
                $("input[name='check_report_group']").each(function(){
                    if ($(this).is(':checked')) {
                        check_report[$(this).val()] = 1;
                        i++;
                    } else {
                        check_report[$(this).val()] = 0;
                        i++;
                    }

                });
                console.log(check_group + " " + JSON.stringify(check_report));

                $.ajax({
                    type: "POST",
                    url: "https://megacrm.megamix.ru/admin/managereport/saveGroupReport",
                    data: "id=" + check_group + "&data=" + JSON.stringify(check_report) + "&_token=" + "{{ csrf_token() }}",
                    success: function (msg) {
                        load_report_group(check_group);
                    }
                });
            });
            $("#save_user_reports").click(function () {
                var check_report = {};
                i=0;
                $("input[name='check_report_user']").each(function(){
                    if ($(this).is(':checked')) {
                        check_report[$(this).val()] = 1;
                        i++;
                    } else {
                        check_report[$(this).val()] = 0;
                        i++;
                    }
                });
                console.log(check_user + " " + JSON.stringify(check_report));

                $.ajax({
                    type: "POST",
                    url: "https://megacrm.megamix.ru/admin/managereport/saveUserReport",
                    data: "id=" + check_user + "&data=" + JSON.stringify(check_report) + "&_token=" + "{{ csrf_token() }}",
                    success: function (msg) {
                        load_report_user(check_user);
                    }
                });
            });
        });
    </script>
@endsection