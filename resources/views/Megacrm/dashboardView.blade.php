@extends('Megacrm.layouts.main')

@section('content')
    <div class="container-fluid">


        <div class="row" id="app">
            <div style="width: 100%" class="row">

                <div class="col-md-12" id="main_app">


                    <div id="maps">
                        <iframe src="https://bxapp.megamix.ru/map/core/public/" width="100%" height="100%">
                            Ваш браузер не поддерживает плавающие фреймы!
                        </iframe>
                        <script type="text/javascript">
                            var width=screen.width; // ширина
                            var height=screen.height; // высота
                            console.log(width + " " + height);
                            $("#maps").css("width", width - 100 + "px");
                            $("#maps").css("height", height - 100 + "px");
                        </script>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
