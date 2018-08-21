
@extends('Megacrm.layouts.main')

@section('content')

{{print_r($VectorMfCounterparties)}}


<div class="container-fluid" style="background-color: white; padding-top: 25px; background-radius: 25px">
    <div class="panel panel-primary">
        <div class="panel-heading">Основная информация</div>
        <div class="panel-body" style="padding-left: 25px">
            <div class="row">
                <div class="col-sm-5">
                    <!--<div class="row text-correct border border-primary rounded-top bg-primary text-white text-correct" id="cpr">Центральный регион</div>-->
                    <div class="row text-correct"><h3 id="title">{{$CounterpartiesInfo[0]->name}}</h3></div>
                    <div class="row text-correct"><h4>Владелец:</h4></div>
                    <div class="row text-correct"><h4 id="managerment_name">{{$CounterpartiesInfo[0]->managerment_name}}</h4></div>
                    <div class="row text-correct"><h4>Должность:</h4></div>
                    <div class="row text-correct"><h4 id="managerment_post">{{$CounterpartiesInfo[0]->managerment_post}}</h4></div>
                    <div class="row">
                        <div class="col-12">
                            <p>Действующий контрагент:
                                @if ($CounterpartiesInfo[0]->action_company == 0)
                                    <input type='checkbox' class='ios8-switch ios8-switch-lg' id='checkbox-3' name="action_company">
                                @else
                                    <input type='checkbox' checked class='ios8-switch ios8-switch-lg' id='checkbox-3' name="action_company">
                                @endif
                                <label for='checkbox-3'></label>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>Нерезидент:
                                @if ($CounterpartiesInfo[0]->dont_resident == 0)
                                    <input type='checkbox' class='ios8-switch ios8-switch-lg' id='checkbox-3' name="dont_resident">
                                @else
                                    <input type='checkbox' checked class='ios8-switch ios8-switch-lg' id='checkbox-3' name="dont_resident">
                                @endif
                                <label for='checkbox-4'></label>
                            </p>
                        </div>
                    </div>
                    <div class="row" style="width: 100%">
                        <div class="col-12" id="headBtn">

                            {{--<div class="input-group mb-3" style="margin-top:10px;">--}}
                            {{--<div class="input-group-prepend">--}}
                            {{--<label class="input-group-text" for="inputGroupSelect01">Статус</label>--}}
                            {{--</div>--}}
                            {{--<select size="1" class="custom-select" id="status">--}}
                            {{--<optgroup label="Лиды" id="status_leads">--}}
                            {{--</optgroup>--}}
                            {{--<optgroup label="Контрагент" id="status_agents">--}}
                            {{--</optgroup>--}}
                            {{--</select>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    {{--<div class="input-group mb-3">--}}
                    {{--<div class="input-group-prepend">--}}
                    {{--<label class="input-group-text" for="inputGroupSelect01">Направление производства</label>--}}
                    {{--</div>--}}
                    {{--<select style="width: 700px" class="custom-select" id="vector_mf">--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--<div class="row" style="margin-bottom: 10px; margin-top: 10px"><div class="col-12"> </div></div>--}}
                    {{--<div class="input-group mb-3">--}}
                    {{--<div class="input-group-prepend">--}}
                    {{--<label class="input-group-text" for="inputGroupSelect01">Ответственный менеджер</label>--}}
                    {{--</div>--}}
                    {{--<select style="width: 700px" class="custom-select" id="responsible_manager">--}}
                    {{--<option>Выбрать менеджера</option>--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    <div class="row" style="width: 100%">
                        <div class="col-sm-12" id="map" style="max-height: 200px"></div>
                    </div>
                    <div class="row" style="width: 100%; margin-bottom: 10px; margin-top: 10px">
                        <div class="col-sm-12" style="max-height: 200px">
                            <a class="btn btn-primary" id="link_map" target="_blank" href="">Показать на карте</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7" id="other_info" style="border-left: 3px solid;">
                    <div class="row"><div class="col-md-4"><p>Головная компания: </p></div><div class="col-md-8"><p id="head_company">{{$CounterpartiesInfo[0]->head_company}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>Полное наименование: </p></div><div class="col-md-8"><p id="fullname">{{$CounterpartiesInfo[0]->fullname}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>Сайт компании: </p></div><div class="col-md-8"><p id="site_company">{{$CounterpartiesInfo[0]->site}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>Юридический адрес: </p></div><div class="col-md-8"><p id="legal_address">{{$Address['legalAddress']}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>Физический адрес: </p></div><div class="col-md-8"><p id="fakt_address">{{$Address['faktAddress']}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>E-mail: </p></div><div class="col-md-8"><p id="email">{{$CounterpartiesInfo[0]->email}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>Телефон: </p></div><div class="col-md-1"><p id="kod_phone">{{$CounterpartiesInfo[0]->kod_phone}}</p></div><div class="col-md-3"><p id="phone">{{$CounterpartiesInfo[0]->phone}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>ИНН: </p></div><div class="col-md-8"><p id="inn">{{$CounterpartiesInfo[0]->inn}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>КПП: </p></div><div class="col-md-8"><p id="kpp">{{$CounterpartiesInfo[0]->kpp}}</p></div></div>
                    <div class="row"><div class="col-md-4"><p>Тип контрагента: </p></div><div class="col-md-8">
                            <select style="width: 500px" class="custom-select" id="type_counterparties">
                                @if ($CounterpartiesInfo[0]->type_counterparties == 1)
                                    <option selected value="1">Юридическое лицо</option>
                                @else
                                    <option value="1">Юридическое лицо</option>
                                @endif

                                @if($CounterpartiesInfo[0]->type_counterparties == 2)
                                    <option selected value="2">Физическое лицо</option>
                                @else
                                    <option value="2">Физическое лицо</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="panel panel-primary">
        <div class="panel-heading">Контактные лица</div>
        <div class="panel-body" style="padding-left: 25px">
            <table class="table table-sm table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Должность</th>
                    <th>День рождения</th>
                    <th>Телефон/факс/E-mail</th>
                </tr>
                </thead>
                <tbody id="contact_table">
                @foreach($KontaktFace as $key => $kontaktFace)
                    <tr onclick='edit_contakt_fields({{$key}})' id='contakt_{{$kontaktFace->id}}'><th></th><td>{{$kontaktFace->name}}</td><td>{{$kontaktFace->position}}</td><td>{{$kontaktFace->birthday}}</td><td>{{$kontaktFace->phone_work}} / {{$kontaktFace->email_work}}</td><td></td></tr>

                @endforeach
                </tbody>
            </table>
            <div class="row" style="width: 100%"><div class="col-12"><div class="btn btn-primary float-left" id="add_contakt_btn">Добавить контакт</div></div></div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">Адреса производств</div>
        <div class="panel-body" style="padding-left: 25px">
            <div class="row" style="width: 100%">
                <div class="col-12">
                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th id="head_name">Наименование</th>
                            <th>Регион</th>
                            <th>Адрес</th>
                            <th>Контактное лицо</th>
                            <th>Контактный телефон</th>
                            <th>Показать на карте</th>
                        </tr>
                        </thead>
                        <tbody id="view_fakt_address"></tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="btn btn-primary " id="add_address_mf_btn">Добавить адрес производства</div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">Направления производства</div>
        <div class="panel-body" style="padding-left: 25px">
            <div class="row" style="width: 100%">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="tabs_vector_mf"></ul>

                </div>
            </div>
            <div class="row" style="width: 100%">
                <div class="col-6">
                    <div class="row" style=" margin-bottom: 10px; margin-top: 10px"><div class="col-12"> </div></div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Ответственный менеджер</label>
                        </div>
                        <select style="width: 100%" class="custom-select" id="responsible_manager">
                            <option>Выбрать менеджера</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group mb-3" style="margin-top:10px;">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Статус</label>
                        </div>
                        <select style="width: 700px" size="1" class="custom-select" id="status">
                            <optgroup label="Лиды" id="status_leads">
                            </optgroup>
                            <optgroup label="Контрагент" id="status_agents">
                            </optgroup>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="width: 100%; margin-top: 30px">
                <div class="col-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Объем продаж:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="50" id="amount_sales" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Объем производства:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="50" id="amount_mf" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="row" style="width: 100%; margin-top: 50px;">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="work_on_company-tab" data-toggle="tab" href="#work_on_company" role="tab" aria-controls="work_on_company" aria-selected="true">Дела по контрагенту</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="lenta-tab" data-toggle="tab" href="#lenta" role="tab" aria-controls="lenta" aria-selected="false">Лента</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="bisproc-tab" data-toggle="tab" href="#bisproc" role="tab" aria-controls="bisproc" aria-selected="false">Бизнес-процессы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">История</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="work_on_company" role="tabpanel" aria-labelledby="work_on_company-tab">
                            <div class="row other_block2" style="width: 100%; margin-top:10px" id="work_on_company">
                                <div class="col-1" style="margin-right: 10px">
                                    <div class="btn btn-primary event_btn" id="add_event_company">+ Событие</div>
                                </div>
                                <div class="col-1" style="margin-right: 10px">
                                    <div class="btn btn-primary event_btn" id="add_event_task">+ Задача</div>
                                </div>
                                <div class="col-1" style="margin-right: 10px">
                                    <div class="btn btn-primary event_btn" id="add_event_mail">+ Письмо</div>
                                </div>
                                <div class="col-1" style="margin-right: 10px">
                                    <div class="btn btn-primary event_btn" id="add_event_meet">+ Встреча</div>
                                </div>
                                <div class="col-1" style="margin-right: 10px">
                                    <div class="btn btn-primary event_btn" id="add_event_call">+ Звонок</div>
                                </div>
                            </div>
                            <div class="row" style="width: 100%; margin-top:10px">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Тема</span>
                                        </div>
                                        <input type="text" id="themeEvent" class="form-control" placeholder="Тема" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 100%; margin-top:10px">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Описание</span>
                                        </div>
                                        <input type="text" id="descEvent" class="form-control" placeholder="Описание" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 100%; margin-top:10px">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Начало события</span>
                                        </div>
                                        <input type="datetime-local" id="startEvent" class="form-control" placeholder="Начало события" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Конец события</span>
                                        </div>
                                        <input type="datetime-local" id="endEvent" class="form-control" placeholder="Конец события" aria-label="Username" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" id="files_attach">
                                    <div class="row" style="width: 100%; margin-top:10px">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Прикрепить фаил</span>
                                                </div>
                                                <input type="file" id="file0" class="activityFiles" class="form-control" aria-label="file" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-6"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="width: 100%; margin-top:10px">
                                <div class="col-12">
                                    <div class="btn btn-primary" id="addFieldFile">Добавить фаил</div>
                                </div>
                            </div>
                            <div class="row" style="width: 100%; margin-top:10px">
                                <div class="col-12">
                                    <div class="btn btn-primary" id="addEvent">Создать событие</div>
                                </div>
                            </div>
                            <div class="row" style="width: 100%; margin-left: 20px; margin-top: 10px">
                                <div class="col-12" id="listTask"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="lenta" role="tabpanel" aria-labelledby="lenta-tab">
                            <div class="row" style="width: 100%; margin-left: 20px; margin-top: 10px"><div class="col-2"><div class="btn btn-outline-primary" id="new_msg_box">Новое сообщение</div><div class="col-10"></div> </div>
                                <div class="row new_msg_tape" style="width: 100%; margin-left: 20px; margin-top: 10px">
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Тема сообщения</span>
                                            </div>
                                            <input type="text" id="themeMsg" class="form-control" placeholder="Тема сообщения" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row new_msg_tape" style="width: 100%; margin-left: 20px; margin-top: 10px">
                                    <div class="col-12">
                                        <textarea style="width: 100%; border-radius: 10px" id="msgLivefeed" placeholder="Ваше сообщение..."></textarea>
                                    </div>
                                </div>
                                <div class="row new_msg_tape" style="width: 100%; margin-left: 20px; margin-top: 10px">
                                    <div class="col-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Кому</span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Кому" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row new_msg_tape" style="width: 100%; margin-left: 20px; margin-top: 10px">
                                    <div class="col-1">
                                        <div class="btn btn-primary" id="sendLivefeetMsg">Отправить</div>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="btn btn-light">Отменить</div>
                                    <div class="col-6"></div>
                                    <div class="col-4"></div>
                                </div>
                                <div class="row" style="width: 100%; margin-left: 20px; margin-top: 10px">
                                    <div class="col-12" id="crmLivefeed"></div>
                                </div>
                                <div class="list-group" id="tape_list" style="width: 100%; margin-left: 20px; margin-top: 10px">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bisproc" role="tabpanel" aria-labelledby="bisproc-tab">...</div>
                            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">...</div>
                        </div>
                    </div>
                </div>
                <div class="row"  style="width: 100%;">
                    <div class="col-12" id="other_block">

                    </div>
                </div>




                <div class="row" style="margin-top: 100px">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4" id="save_btn_group">
                        button +
                    </div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </div>
    </div>




</div>

    <script type="text/javascript">
        function edit_contakt_fields (id) {

            $("#exampleModal_5").modal("show");


            $("#model_show_fields_5").html("<img src=\"image/loader.gif\">");

            $("#model_show_fields_5").html("<div class=\"row\"><div class=\"col-sm-12\">Информация о контакте</div></div>");


            if (contact_table == "edit") {
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">ФИО: </span><input class=\"form-control\" type=\"text\" name=\"name\" id=\"name\" value=\"" + kontakt_info[id].name + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">Должность: </span><input class=\"form-control\" type=\"text\" name=\"position\" id=\"position\" value=\"" + kontakt_info[id].position + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">Дата рождения: </span><input class=\"form-control\" type=\"date\" name=\"birthday\" id=\"birthday\" value=\"" + kontakt_info[id].birthday + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">Телефон рабочий: </span><input class=\"form-control\" type=\"text\" name=\"phone_work\" id=\"phone_work\" value=\"" + kontakt_info[id].phone_work + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">Телефон личный: </span><input class=\"form-control\" type=\"text\" name=\"phone_home\" id=\"phone_home\" value=\"" + kontakt_info[id].phone_home + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">EMAIL рабочий: </span><input class=\"form-control\" type=\"text\" name=\"email_work\" id=\"email_work\" value=\"" + kontakt_info[id].email_work + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">EMAIL личный: </span><input class=\"form-control\" type=\"text\" name=\"email_home\" id=\"email_home\" value=\"" + kontakt_info[id].email_home + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"input-group\"><span class=\"input-group-addon\" id=\"basic-addon1\">Дополнительная информация: </span><input class=\"form-control\" type=\"text\" name=\"desc\" id=\"desc\" value=\"" + kontakt_info[id].desc + "\"></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><button type=\"button\" class=\"btn btn-danger\" data-toggle=\"button\" aria-pressed=\"false\" onclick=\"remove_kontakt('" + kontakt_info[id].id + "')\" autocomplete=\"off\">Удалить контакт</button></div><div class=\"col-sm-6\"></div></div>");


                var send_str = "";
                $("input").change(function () {

                    send_str = send_str + "&" + $(this).attr("name") + "=" + $(this).val();
                    console.log($(this).attr("name"));
                    i++;
                });
            } else {
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>ФИО: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].name + "</p></div></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>Должность: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].position + "</p></div></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>Дата рождения: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].birthday + "</p></div></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>Телефон рабочий: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].phone_work + "</p></div></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>Телефон личный: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].phone_home + "</p></div></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>EMAIL рабочий: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].email_work + "</p></div></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>EMAIL личный: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].email_home + "</p></div></div>");
                $("#model_show_fields_5").append("<div class=\"row\"><div class=\"col-sm-6\"><p>Дополнительная информация: </p></div><div class=\"col-sm-6\"><p>" + kontakt_info[id].desc + "</p></div></div>");
            }


            $("#add_fields_btn").click(function () {
                console.log(send_str);

                $.ajax({
                    type: "POST",
                    url: "scripts/save/save_kontakt.php",
                    data: "id_company=" + change_company + "&id_contakt=" + kontakt_info[id].id + send_str,
                    success: function (msg) {
                        $('#exampleModal_5').modal('hide');
                        // card_view (change_company);
                        send_str = "";
                        $.ajax({
                            type: "POST",
                            url: "scripts/get/get_contakt_face.php",
                            data: "id=" + change_company,
                            success: function (msg) {
                                var data = $.parseJSON(msg);
                                kontakt_counter = 1;
                                kontakt_info = data;
                                $("#contact_table").html("");
                                $.each(data, function (key, value) {
                                    $("#contact_table").append("<tr onclick='edit_contakt_fields(\"" + key + "\")' id='contakt_" + value.id + "'><th>" + kontakt_counter + "</th><td>" + value.name + "</td><td>" + value.position + "</td><td>" + value.birthday + "</td><td>" + value.phone_work + " / " + value.email_work + "</td><td></td></tr>");

                                    kontakt_counter++;
                                });

                                $("#title").text(data.name);
                                $("#site_company").text(data.site);
                                $("#head_company").text(data.head_company);
                                $("#title").text(data.name);
                                $("#title").text(data.name);

                            }
                        });
                    }
                });

            });

        }
    </script>

@endsection