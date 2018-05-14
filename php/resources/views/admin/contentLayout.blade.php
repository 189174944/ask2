<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('semantic/dist/semantic.css')}}" rel="stylesheet"/>
    <link href="{{asset('plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/main.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet"/>
    <link href="{{asset('plugins/pacejs/pace.css')}}" rel="stylesheet"/>
    <link href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet"/>
    {{--select2--}}
    <link href="{{asset('bower_components/select2/dist/css/select2.min.css')}}" rel="stylesheet"/>
    {{--select2--}}
</head>
<body>
<div class="row">
    <div class="sixteen wide column">
        <div class="ui segments">
            @yield('content')
            {{--<div class="ui segment">--}}
            {{--<h5 class="ui header">--}}
            {{--用户管理--}}
            {{--</h5>--}}
            {{--</div>--}}
            {{--<div class="ui segment">--}}

            {{--<div class="ui fluid action input">--}}
            {{--<input type="text" placeholder="Search...">--}}
            {{--<div class="ui button">Search</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
<script src="{{asset('js/bower_components/vue/dist/vue.min.js')}}"></script>
<script src="{{asset('js/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('bower_components/layer/dist/layer.js')}}"></script>
<script src="{{asset('semantic/dist/semantic.min.js')}}"></script>
<script src="{{asset('plugins/cookie/js.cookie.js')}}"></script>
<script src="{{asset('plugins/nicescrool/jquery.nicescroll.min.js')}}"></script>
<script src="{{asset('plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script data-pace-options='{ "ajax": false }' src="{{asset('plugins/pacejs/pace.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
{{--select2--}}
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
{{--select2--}}
@yield('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
