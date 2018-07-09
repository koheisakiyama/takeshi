<!DOCTYPE html>
<html>
    <head>
        <title>pay search</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/bootstrap-multiselect.css')}}" rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/javascripts/jquery-3.3.1.js') }}"></script>
    <script src = "{{ asset('assets/javascripts/bootstrap.min.js') }}"></script>
    <script src = "{{ asset('assets/javascripts/bootstrap-multiselect.js') }}"></script>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">pay search</div>
                <!--ウェルカム画面のボタンを押すとindexに遷移する -->
                <a href="/search" class="btn btn-primary btn-lg">
                <i class="glyphicon glyphicon-ruble"></i>Lets start!!!</a>
        </div>
    </body>
</html>
