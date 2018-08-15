@extends('Megacrm.layouts.main')

@section('content')
    <div class="container">
        <div class="row header">
            <div class="col-md-12">
                <div id="top_menu">

                    <nav>
                        <ul class="nav nav-tabs" id="top_menu_items">
                            <li class="nav-item">
                                <a href="{{ url('/profile') }}" class="nav-link active" onclick="" id="menu_home">Главная</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Все клиенты</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="counterparties_view('DATE_CREATE','DESC','0')"  id="all_counterparties">Контрагенты</a>
                                    <a class="dropdown-item" href="#" onclick="leads_view('DATE_CREATE','DESC')"  id="all_leads">Лиды</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Персональные отчеты
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" onclick='getReportActOrderShip()'>Актуальные заявки на поставку</a>
                                    <a class="dropdown-item" href="#" onclick='getReportPretenzii()'>Жалобы претензии</a>
                                    <a class="dropdown-item" href="#" onclick='getReportRunOrder()'>Исполнение заявок</a>
                                    <a class="dropdown-item" href="#" onclick='getReportSalesOnAnimal()'>Продажи по видам животных</a>
                                    <a class="dropdown-item" href="#" onclick='getReportAnalPlanMeneger()'>Анализ планов менеджера</a>
                                    <a class="dropdown-item" href="#" onclick='getReportNoWorkPlan()'>Не обработанные планы менеджера</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Общие отчеты
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" onclick='report_plan_mf()'>План производства</a>
                                    <a class="dropdown-item" href="#" onclick='report_manager_plan_mf()'>План менеджера на производства</a>
                                    <a class="dropdown-item" href="#" onclick='getReportDispatch()'>Текущие отгрузки</a>
                                    <a class="dropdown-item" href="#" onclick='getAnalProdSklad()'>Анализ доступности товаров</a>

                                </div>
                            </li>
                        </ul>
                    </nav>

                    <!--<div class="tabbar tabbar&#45;&#45;top tabbar&#45;&#45;material">-->
                    <!--<label class="tabbar__item tabbar&#45;&#45;material__item" onclick="location.href('https://bxapp.megamix.ru/megacrm/index.html')" id="menu_home">-->
                    <!--<input type="radio" name="tabbar-material-a" checked="checked">-->
                    <!--<button class="tabbar__button tabbar&#45;&#45;material__button">-->
                    <!--Главная-->
                    <!--</button>-->
                    <!--</label>-->

                    <!--<label class="tabbar__item tabbar&#45;&#45;material__item" onclick="counterparties_view('DATE_CREATE','DESC','0')"  id="all_counterparties">-->
                    <!--<input type="radio" name="tabbar-material-a">-->
                    <!--<button class="tabbar__button tabbar&#45;&#45;material__button">-->
                    <!--Контрагенты-->
                    <!--</button>-->
                    <!--</label>-->

                    <!--<label class="tabbar__item tabbar&#45;&#45;material__item" onclick="leads_view('DATE_CREATE','DESC')"  id="all_leads">-->
                    <!--<input type="radio" name="tabbar-material-a">-->
                    <!--<button class="tabbar__button tabbar&#45;&#45;material__button">-->
                    <!--Лиды-->
                    <!--</button>-->
                    <!--</label>-->

                    <!--<label class="tabbar__item tabbar&#45;&#45;material__item">-->
                    <!--<input type="radio" name="tabbar-material-a">-->
                    <!--<button class="tabbar__button tabbar&#45;&#45;material__button">-->
                    <!--Games-->
                    <!--</button>-->
                    <!--</label>-->
                    <!--</div>-->
                </div>
            </div>
        </div>

        <div class="row" id="app">
            <div style="width: 100%" class="row">

                <div class="col-md-12" id="main_app">
                    <div id="maps">
                        {{--<iframe src="https://bxapp.megamix.ru/map/core/public/" width="100%" height="830px">--}}
                            {{--Ваш браузер не поддерживает плавающие фреймы!--}}
                        {{--</iframe>--}}
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
