function counterparties_sales() {
    $("#model_show_fields_7").html("<div class='row'><div class='col-sm-4'>" +
        "<span>От: <input type='date' name='from'></span></div>" +
        "<div class='col-sm-4'>" +
        "<span>По: <input type='date' name='to'></span></div>" +
        "<div class='col-sm-4'><div class='btn btn-primary' id='view'>Показать</div></div>" +
        "<div class='row' id='report' style='margin-left: 50px;margin-top: 50px;'></div>");

    $("#view").click(function () {
       var from = $("input[name='from']").val();
       var to = $("input[name='to']").val();

        $.ajax({
            type: "POST",
            url: "resources/views/Megacrm/tsd/get_report.php",
            data: "from=" + from + "&to=" + to + "&guid=" + guid,
            success: function (msg) {
                if (msg != "SaleReport") {
                    $("#report").html(msg);
                    $(".table-bordered").css("border-color", "#000000");
                } else {

                }

            }
        });

    });


    $("#exampleModal_7").modal("show");
}

function counterparties_recept() {
    $("#report_window").dialog({title:'Рецепты контрагента'});
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 50px;margin-top: 50px;'><img src='image/loader.gif' style='margin-left: 48%'/></div>");

    $("#from_date").hide();
    $("#to_date").hide();
    $("#btn_rep_view").hide();

    $.ajax({
            type: "POST",
            url: "resources/views/Megacrm/tsd/get_salerecept.php",
            data: "guid=" + guid,
            success: function (msg) {
                if (msg != "SaleRecept") {
                    console.log(msg);
                    $("#report").html(msg);
                    $(".table-bordered").css("border-color", "#000000");
                    console.log($("#report .btn").addClass("to_cart"));
                } else {

                }
            }
        });
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function get_sostav (guid) {
    $("#report_window").dialog({title:'Состав рецепта'});
    $("#report_sostav_window_body").html("<div class='row' id='report_sostav' style='margin-left: 50px;margin-top: 50px;'></div>");

    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/get_receptsostav.php",
        data: "guid=" + guid,
        success: function (msg) {
            if (msg != "ReceptSostav") {
                $("#report_sostav").html(msg);
                $(".table-bordered").css("border-color", "#000000");
            } else {

            }

        }
    });
    $( "#report_sostav_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });

    $("#report_sostav_window").dialog("open");
}

function report_plan_mf(from_report, to_report) {
    change_report = "report_plan_mf";
    $("#from_date").show();
    $("#to_date").show();
    $("#btn_rep_view").show();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/get_report_plan_mf.php",
        data: "id_user=" + user_id + "&id_report=3" + "&from=" + from_report + "&to=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Планы производства'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function report_manager_plan_mf(from_report, to_report) {
    change_report = "report_manager_plan_mf";
    $("#from_date").show();
    $("#to_date").show();
    $("#btn_rep_view").show();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 50px;margin-top: 50px;'><img src='image/loader.gif' style='margin-left: 48%'/></div>");

    if (typeof from == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/get_report_manag_plan_mf.php",
        data: "id_user=" + user_id + "&id_report=5" + "&from_report=" + from_report + "&to_report=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
                    "    Ваш браузер не поддерживает плавающие фреймы!\n" +
                    " </iframe>");

                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });

    $("#report_window").dialog({title:'Планы производства'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getReportDispatch() {
    change_report = "getReportDispatch";
    $("#from_date").hide();
    $("#to_date").hide();
    $("#btn_rep_view").hide();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 50px;margin-top: 50px;'><img src='image/loader.gif' style='margin-left: 48%'/></div>");

    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/get_report_dispatch.php",
        data: "id_user=" + user_id + "&id_report=7",
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
                    "    Ваш браузер не поддерживает плавающие фреймы!\n" +
                    " </iframe>");
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });

    $("#report_window").dialog({title:'Текущие отгрузки'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getAnalProdSklad() {
    change_report = "getAnalProdSklad";
    $("#from_date").hide();
    $("#to_date").hide();
    $("#btn_rep_view").hide();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 50px;margin-top: 50px;'><img src='image/loader.gif' style='margin-left: 48%'/></div>");

    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/get_anal_prod_sklad.php",
        data: "id_user=" + user_id + "&id_report=6",
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
                    "    Ваш браузер не поддерживает плавающие фреймы!\n" +
                    " </iframe>");

                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }

        }
    });

    $("#report_window").dialog({title:'Анализ доступности товаров'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");

}

function getReportActOrderShip() {
    change_report = "getReportActOrderShip";
    $("#from_date").hide();
    $("#to_date").hide();
    $("#btn_rep_view").hide();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: {{ url('resources/views/Megacrm/tsd') }} + "/getReportActOrderShip.php",
        data: "id_user=" + user_id + "&id_report=9" + "&from=" + from_report + "&to=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Актуальные заявки на поставку'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getReportNoWorkPlan() {
    change_report = "getReportNoWorkPlan";
    $("#from_date").hide();
    $("#to_date").hide();
    $("#btn_rep_view").hide();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/getReportNoWorkPlan.php",
        data: "id_user=" + user_id + "&id_report=8" + "&from=" + from_report + "&to=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Не обработанные планы менеджера'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getReportPretenzii(from_report, to_report, id_user) {
    change_report = "getReportPretenzii";
    $("#from_date").show();
    $("#to_date").show();
    $("#btn_rep_view").show();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() - 4) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/getReportPretenzii.php",
        data: "id_user=" + user_id + "&id_report=10" + "&from=" + from_report + "&to=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Жалобы претензии'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getReportRunOrder(id_user) {
    change_report = "getReportRunOrder";
    $("#from_date").hide();
    $("#to_date").hide();
    $("#btn_rep_view").hide();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/getReportRunOrder.php",
        data: "id_user=" + user_id + "&id_report=11" + "&from=" + from_report + "&to=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Исполнение заявок'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getReportSendPlan(id_user) {
    change_report = "getReportSendPlan";
    $("#from_date").hide();
    $("#to_date").hide();
    $("#btn_rep_view").hide();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/getReportSendPlan.php",
        data: "id_user=" + user_id + "&id_report=12",
        success: function (msg) {
            console.log(msg);
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Исполнение заявок'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getReportSalesOnAnimal(from_report, to_report, id_user) {
    change_report = "getReportSalesOnAnimal";
    $("#from_date").show();
    $("#to_date").show();
    $("#btn_rep_view").show();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/getReportSalesOnAnimal.php",
        data: "id_user=" + user_id + "&id_report=12" + "&from=" + from_report + "&to=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Продажи по видам животных'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

function getReportAnalPlanMeneger(from_report, to_report, id_user) {
    hange_report = "getReportAnalPlanMeneger";
    $("#from_date").show();
    $("#to_date").show();
    $("#btn_rep_view").show();
    $("#report_window_body").html("<div class='row' id='report' style='margin-left: 20px;margin-top: 50px;'><div class='col-sm-12'>" +
        "<img src='image/loader.gif' style='margin-left: 48%'/></div></div>");


    if (typeof from_report == "undefined") {
        var date = new Date();
        from_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
        to_report = date.getDate() + "." + (date.getUTCMonth() + 1) + "." + date.getFullYear();
    }

    $("#report").html("<iframe src=\"\" width=\"100%\" height=\"100%\">" +
        "    Ваш браузер не поддерживает плавающие фреймы!\n" +
        " </iframe>");


    $.ajax({
        type: "POST",
        url: "resources/views/Megacrm/tsd/getReportAnalPlanMeneger.php",
        data: "id_user=" + user_id + "&id_report=13" + "&from=" + from_report + "&to=" + to_report,
        success: function (msg) {
            if (msg == "Нет доступа к отчету") {
                $("#report").text(msg);
            } else {
                $("#report iframe").attr("src", "https://bxapp.megamix.ru/Megacrm/reports_files/" + msg + ".html");
            }
        }
    });


    $("#report_window").dialog({title:'Анализ планов менеджера'});
    $("#report").css("height", $(window).height() - 300);
    $( "#report_window" ).dialog({
        position: { my: "left top", at: "left top", of: "#app" },
        width: $(window).width() - 50,
        height: $(window).height() - 100
    });
    $("#report_window").dialog("open");
}

var check_group = 0;
var check_user = 0;
function report_manager() {
    $("#toolbar").html("");
    manager_report();
    $(".mainMenu").removeClass("active");
    $("#administration").addClass("active");

    $("#main_app").html('' +
        '<div class="row">' +
            '<div class="col-3"></div>' +
            '<div class="col-6"><h4>Управления отчетами</h4></div>' +
            '<div class="col-3"></div>' +
        '</div>' +



        '<div class="row">' +
        '<div class="col-6"><h4>Группы</h4></div>' +
        '<div class="col-6"></div>' +
        '</div> ' +
        '<div class="row">' +
            '<div class="col-6">' +
        '<div class="list-group" id="list_group"></div>' +
        '</div>' +
            '<div class="col-6" id="list_reports">' +
        '</div>' +
        '</div>' +
        '<div class="row"><div class="col-12"><div class="btn btn-primary" id="save_group_reports">Сохранить</div> </div> </div> ' +
        '<div class="row">' +
        '<div class="col-6"><h4>Пользователи</h4></div>' +
        '<div class="col-6"></div>' +
        '</div> ' +
        '<div class="row">' +
        '<div class="col-6">' +
        '<div class="list-group" id="list_user"></div>' +
        '</div>' +
        '<div class="col-6" id="list_reports_user">' +
        '</div>' +
        '</div>' +
        '<div class="row"><div class="col-12"><div class="btn btn-primary" id="save_user_reports">Сохранить</div> </div> </div> ');

    $.ajax({
        type: "POST",
        url: "{{ url('/resources/views/Megacrm/tsd') }}/get_group_report.php",
        success: function (msg) {
            var data = $.parseJSON(msg);

            $.each(data, function (key, value) {
                $("#list_group").append("<a href=\"#\" class=\"list-group-item list-group-item-action group_list\" id=\"group_" + value.id_group + "\" onclick=\"load_report_group('" + value.id_group + "')\">" + value.name + "</a>");
            });
        }
    });
    $.ajax({
        type: "POST",
        url: "{{ url('/resources/views/Megacrm/tsd') }}/get_user_report.php",
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
                            name = result.data()[0].NAME + " " + result.data()[0].LAST_NAME;

                            $("#list_user").append("<a href=\"#\" class=\"list-group-item list-group-item-action user_list\" id=\"user_" + value.id_user + "\" onclick=\"load_report_user('" + value.id_user + "')\">" + name + "</a>");
                            if(result.more())
                                result.next();
                        }
                    });


            });
        }
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
            url: "{{ url('/resources/views/Megacrm/tsd') }}/save_group_report.php",
            data: "id=" + check_group + "&data=" + JSON.stringify(check_report),
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
            url: "{{ url('/resources/views/Megacrm/tsd') }}/save_user_report.php",
            data: "id=" + check_user + "&data=" + JSON.stringify(check_report),
            success: function (msg) {
                load_report_user(check_user);
            }
        });
    });
}

function load_report_group(id) {
    check_group = id;
    $(".group_list").removeClass("active");
    $("#group_" + id).addClass("active");
    $("#list_reports").html("");
    $.ajax({
        type: "POST",
        url: "{{ url('/resources/views/Megacrm/tsd') }}/get_report_in_group.php",
        data: "id=" + id,
        success: function (msg) {
            var data = $.parseJSON(msg);

    $.each(data, function (key, value) {

        if (value.checked) {

            $("#list_reports").append("<div class=\"form-check\">" +
                "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_group\" value=\"" + value.id_report + "\" id=\"exampleRadios1\" checked>" +
                "  <label class=\"form-check-label\" for=\"exampleRadios1\">" + value.name + "  </label>" +
                "</div>");
        } else {

            $("#list_reports").append("<div class=\"form-check\">" +
                "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_group\" value=\"" + value.id_report + "\" id=\"exampleRadios1\">" +
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
        url: "{{ url('/resources/views/Megacrm/tsd') }}/get_report_in_user.php",
        data: "id=" + id,
        success: function (msg) {
            var data = $.parseJSON(msg);

            $.each(data, function (key, value) {
                $("#list_reports").html("");

                if (value.checked) {
                    $("#list_reports_user").append("<div class=\"form-check\">" +
                        "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_user\" value=\"" + value.id_report + "\" id=\"exampleRadios2\" checked>" +
                        "  <label class=\"form-check-label\" for=\"exampleRadios2\">" + value.name + "  </label>" +
                        "</div>");
                } else {
                    $("#list_reports_user").append("<div class=\"form-check\">" +
                        "  <input class=\"form-check-input\" type=\"checkbox\" name=\"check_report_user\" value=\"" + value.id_report + "\" id=\"exampleRadios2\">" +
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
        url: "resources/views/Megacrm/get_group.php",
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
            url: "{{ url('/resources/views/Megacrm/tsd') }}/add_group_report.php",
            data: "id=" + group_list_report,
            success: function (msg) {
                if (msg == "error") {
                    $("#status_save").text("Ошибка");
                } else {
                    $("#status_save").text("Сохранено");
                    $.ajax({
                        type: "POST",
                        url: "{{ url('/resources/views/Megacrm/tsd') }}/get_group_report.php",
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
        url: "{{ url('resources/views/Megacrm/tsd') }}/add_user_report.php",
        data: "id=" + user_list_report,
        success: function (msg) {
            $("#list_user").html("");

            if (msg == "error") {
                $("#status_save").text("Ошибка");
            } else {
                $("#status_save").text("Сохранено");
                $.ajax({
                    type: "POST",
                    url: "{{ url('/resources/views/Megacrm/tsd') }}/get_user_report.php",
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