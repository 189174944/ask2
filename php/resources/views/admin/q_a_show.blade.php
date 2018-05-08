@extends('admin.contentLayout')
@section('content')
    <div class="ui segments">
        <div class="ui segment">
            @if($artical->type==1)
                <button onclick="history.back()" class="ui green button">返回</button>
            @else
                <button onclick="history.back()" class="ui green button">返回</button>
            @endif
        </div>
    </div>
    <div class="ui segments">

        <div class="ui segment">
            <h5 class="ui header">
                【
                @if($artical->type==1)
                    文章
                @else
                    问题
                @endif
                】{{$artical->title}}
            </h5>
        </div>
        <div class="ui segment">
            @foreach($artical->topic as $k)
                {{$colors[rand(0,4)]}}
                <a class="ui {{$colors[rand(0,4)]}} circular label">{{$k->name}}</a>
            @endforeach
        </div>
        <div class="ui segment">
            作者:{{$artical->users->nickname}}
            发布时间:{{$artical->created_at}}
        </div>
        <div class="ui segment">
            {{$artical->content}}
        </div>
        <div class="ui segment">
            被收藏数量({{$collectCount}})、

            @if($artical->type==1)
                被评论数量({{$artical->comment->count()}})
            @else
                被回答数量({{$artical->comment->count()}})
            @endif

        </div>
        <div class="ui center aligned segment">
            <button class="positive ui button">通过审核</button>
            <button class="yellow ui button">驳回请求</button>
            <button class="negative ui button">删除文章</button>
        </div>
    </div>
    <div class="ui segments">
        <div class="ui segment">
            <h5 class="ui header">

                @if($artical->type==1)
                    评论
                @else
                    回答
                @endif
            </h5>
        </div>
        <div class="ui segment">
            <div class="ui threaded comments">
                <div class="ui comments" style="padding-bottom:13px">
                    @foreach($artical->comment as $k)
                        <div class="comment">
                            <a class="avatar">
                                <img src="{{$k->users->avatar or url('img/avatar/default/avatar.png')}}">
                            </a>
                            <div class="content">
                                <a class="author">{{$k->users->nickname}}</a>
                                <div class="text">
                                    {{$k->content}}
                                </div>
                                <div class="actions">
                                    <a class="hide">{{$k->users->created_at}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
