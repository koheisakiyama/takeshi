<!DOCTYPE html>
<html>
  <head>
    <title>pay search</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/css/bootstrap-multiselect.css')}}" rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/javascripts/shops/errorCallback.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/initMap.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/drawUserMarker.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/currentLocation.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/measureDistance.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/getLatLng.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/result.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/userAndShop.js') }}"></script>
    <script src="{{ asset('assets/javascripts/shops/navi.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('Google_API_Key') }}&libraries=geometry"></script>
    <script src="{{ asset('assets/javascripts/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('assets/javascripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/javascripts/bootstrap-multiselect.js') }}"></script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      html, body, div.row-fluid, div.container-fluid{
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
      }
       #navTgl:checked ~ .contents {
          -webkit-transform: translateY(250px);
        transform: translateY(250px);
      }
      #navTgl {
        display: none;
        overflow: hidden;
      }
      .open {
        z-index: 2;
        width: 150px;
        height: 30px;
        color: white;
        background-color: #A3D1FF;
        font-size: 2em;
        line-height: 50px;
        text-align: center;
        -webkit-transition: background-color .6s, -webkit-transform .6s;
        transition: background-color .6s, transform .6s;
       }
       #navTgl:checked + .open {
        background-color: indianRed;
        -webkit-transform: translateY(-500px);
        transform: translateY(-500px);
       }
       .close {
        pointer-events: none;
        z-index: 1;
        width: 100%;
        height: 100%;
        transition: background-color .6s;
       }
       #navTgl:checked ~ .close {
        pointer-events: auto;
        background-color: rgba(0,0,0,.3);
       }
       .search-result {
          z-index: 1;
          position: fixed;
          overflow: auto;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          padding: 10px;
          background-color: rgba(0,0,0,.6);
          -webkit-transform: translateY(100%);
          transform: translateY(100%);
          -webkit-transition: -webkit-transform .6s;
          transition: transform .6s;
       }
        #navTgl:checked ~ .search-result {
          -webkit-transform: translateY(250px);
          transform: translateY(250px);
        }
    </style>
  </head>

  <body>
    <header class="page-header" style="padding: 0;background-color: #A3D1FF; margin:0; height:10%;width:100%;">
      <nav class="navbar navbar-inverse" style="background-color: #A3D1FF; border-color: #A3D1FF; margin:0;">
        <div class="container-fluid">
         {{ Form::open(['action' => 'ShopsController@result', 'method' => 'get', 'style'=>'width=100%;']) }}
          <ul class="nav navbar-nav" style="padding: 0px;width:100%;">
            <li class="active"><a href="/" style="padding: 0;background-color: #A3D1FF; margin:0;"><h1 style="margin: 10px;">pay search</h1></a></li>
            <li style="width:15%"><a>@include ('shops.details.how')</a></li>
            <li style="width:10%"><a>@include ('shops.details.what')</a></li>
            <li style="width:10%"><a>@include ('shops.details.where')</a></li>
            <li>
              <div style="margin: 15px;margin-right: 20px;">
                {{ Form::text('keyword', '', ['placeholder' => 'フリーワード検索', 'style' => 'width: 100%;height: 30px;']) }}
              </div>
            </li><!-- フリーワード検索ボックス -->
            <li style="width: 5%;">
              <a>{{ Form::submit('検索', ['class' => 'btn btn-primary navbar-form']) }}</a>
            </li><!-- 検索ボタン -->
            {{ Form::close() }}

            <!-- 会員機能関連 -->
            @if (Auth::check())

                <!-- ログイン機能ver2 -->
                <div class="navbar-right" style="margin-right: 3%;font-size: 17px;">
            <span>
              <div style="margin-bottom: 0;margin-top: 1%;"> 
              ようこそ{{ Auth::user()->name }}さん
            </div>
              <!-- <ul class="user__info"> -->
                <li>
                  <a href="/users/{{ Auth::user()->id }}"><button type="button" class="btn btn-primary navbar-form">マイページ</button></a>
                  <a href="/logout"><button type="button" class="btn btn-primary navbar-form">ログアウト</button></a>
                </li>
              <!-- </ul> -->
            </span>
            <!-- <a class="post" href="/tweets/create">投稿する</a> -->
          </div>

            @else
                <!-- ルートを変更が必要 -->
                <li class="navbar-right" style="margin-right: 75px;"><a href="/login" style="width: 15%;"><button type="button" class="btn btn-default navbar-btn">ログイン</button></a></li>
                <li class="navbar-right" style="margin-right: 15px; "><a href="/register" style="width: 15%;"><button type="button" class="btn btn-default navbar-btn">新規登録</button></a></li>
            @endif

          </ul>
            <!-- 会員機能関連ここまで -->


        </div>
      </nav>
    </header>

    <div class="container-fluid" style="height:90%;width:100%;">
      <div class="row-fluid">
        <!-- jsファイルを作成　seina -->
        <script type="text/javascript">
          var current = null; // 現在地
          var center = {lat: 35.6284,lng: 139.736571};
          var map = null;        // 地図オブジェクト
          var userMarker = null; // マーカーオブジェクト
          var errCir = null;     // 誤差の範囲
          // 現在地取得のオプション
          var getOpt = {
            enableHighAccuracy : true,
            maximumAge         : 35000,
            timeout            : 30000,
          };
        </script>
        @yield ('content')

      </div>
    </div>
  </body>
</html>
