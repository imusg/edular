<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="//code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MegaCRM</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">--}}

    <script type="text/javascript">
        var user_id = "";
        var urlReport = "";
        window.onload = function () {
            user_id = {{ Auth::user()->id }};
            urlReport = "{{ url('Megacrm') }}";
            console.log(user_id);
        }

    </script>
    <script type="text/javascript" src="{{ asset('js/reports.js') }}"></script>
    <style>
        #maps {
            margin:0 2% 0 2%;
        }

    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/crm') }}">
                    MegaCRM
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ url('/crm') }}">Главная <span class="sr-only">(current)</span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Все клиенты <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/crm/counterparties/page/1?date=DATE_CREATE&sort=DESC') }}"  id="all_counterparties">Контрагенты</a></li>
                            <li><a class="dropdown-item" href="#" onclick="leads_view('DATE_CREATE','DESC')"  id="all_leads">Лиды</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Персональные отчеты<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick='getReportActOrderShip()'>Актуальные заявки на поставку</a></li>
                            <li><a class="dropdown-item" href="#" onclick='getReportPretenzii()'>Жалобы претензии</a></li>
                            <li><a class="dropdown-item" href="#" onclick='getReportRunOrder()'>Исполнение заявок</a></li>
                            <li><a class="dropdown-item" href="#" onclick='getReportSalesOnAnimal()'>Продажи по видам животных</a></li>
                            <li><a class="dropdown-item" href="#" onclick='getReportAnalPlanMeneger()'>Анализ планов менеджера</a></li>
                            <li><a class="dropdown-item" href="#" onclick='getReportNoWorkPlan()'>Не обработанные планы менеджера</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Общие отчеты<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick='report_plan_mf()'>План производства</a></li>
                            <li><a class="dropdown-item" href="#" onclick='report_manager_plan_mf()'>План менеджера на производства</a></li>
                            <li><a class="dropdown-item" href="#" onclick='getReportDispatch()'>Текущие отгрузки</a></li>
                            <li><a class="dropdown-item" href="#" onclick='getAnalProdSklad()'>Анализ доступности товаров</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/admin') }}">Админ главная <span class="sr-only">(current)</span></a></li>
                    @if ($Admin)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Общие отчеты<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick='report_plan_mf()'>План производства</a></li>
                                <li><a class="dropdown-item" href="#" onclick='report_manager_plan_mf()'>План менеджера на производства</a></li>
                                <li><a class="dropdown-item" href="#" onclick='getReportDispatch()'>Текущие отгрузки</a></li>
                                <li><a class="dropdown-item" href="#" onclick='getAnalProdSklad()'>Анализ доступности товаров</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Войти</a></li>
                    @else

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
