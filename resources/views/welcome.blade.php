<!DOCTYPE html>
<html>
    <head>
        <title>pay search</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href='/assets/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
        <link href='/assets/css/bootstrap-multiselect.css' rel='stylesheet' type='text/css'>
        <script src='/assets/javascripts/jquery-3.3.1.js'></script>
        <script src ='/assets/javascripts/bootstrap.min.js'></script>
        <script src ='/assets/javascripts/bootstrap-multiselect.js'></script>

        <style>
            html, body {
                height: 100%;
                width: 100%;
            }

            /*コードの順番変更*/
             .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
                width: 100%;
                margin: auto;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                text-align: center;
                font-family: 'Lato';
                /*背景変更*/
                background: #1c92d2;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #f2fcfe, #1c92d2);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #f2fcfe, #1c92d2); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            }

            .content {
                text-align: center;
                display: inline-block;
                margin: auto;
            }

            .title {
                font-size: 96px;
            }

            /*テキスト追加*/
            .text {
                font-size: 30px;
                color: #74748b;
            }

            /*ボタン位置変更*/
            .white {
                padding-top: 20px;
            }


        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">pay search</div>
                <div class="text" style="padding-bottom: 30px">
                あなたのキャッシュレス決済を、もっと賢く、スマートに</div>
                <!--ウェルカム画面のボタンを押すとindexに遷移する -->
                <a href="/search" class="btn btn-primary btn-lg">
                <i class="glyphicon glyphicon-ruble"></i>Lets start!!!</a>
        </div>
    </body>
</html>
