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
            【{{$artical->type==1?"文章":"问题"}}】{{$artical->title}}
            <div class="ui inline dropdown upward" tabindex="0">
                {{--<div class="text ui green circular label">操作</div>--}}
                @if($artical->status==1)
                    <a class="text ui green circular label">

                    </a>
                @elseif($artical->status==2)
                    <a class="text ui green circular label">
                        待审核
                    </a>
                @elseif($artical->status==3)
                    <a class="text ui green circular label">
                        通过审核
                    </a>
                @elseif($artical->status==4)
                    <a class="text ui green circular label">
                        已撤回
                    </a>
                @elseif($artical->status==5)
                    <a class="text ui green circular label">
                        驳回请求
                    </a>
                @endif
                <i class="dropdown icon"></i>
                <div class="menu transition hidden" tabindex="-1">
                    <div class="item" onclick="checkOk(this,'{{$artical->id}}')">通过审核</div>
                    <div class="item" onclick="checkNo(this,'{{$artical->id}}')">驳回请求</div>
                    <div class="item" onclick="block(this,'{{$artical->id}}')">屏蔽
                    </div>
                    <div class="item" style="background-color: red;color: white"
                         onclick="cancelBlock(this,'{{$artical->id}}')">解除屏蔽
                    </div>
                </div>
            </div>
        </div>
        <div class="ui segment">
            话题:
            @foreach($artical->topic as $k)
                {{--{{$colors[rand(0,4)]}}--}}
                <a class="ui {{$colors[rand(0,4)]}} circular label">{{$k->name}}
                    <i class="icon delete" data-artical_id="{{$artical->id}}" data-topic_id="{{$k->id}}"
                       onclick="deleteTopic(this,$(this).data('artical_id'),$(this).data('topic_id'))"></i>
                </a>
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
            <i class="star yellow icon"></i>({{$collectCount}})
            <i class="{{$artical->type==1?"comment":"comment" }} green icon"></i>({{$artical->comment->count()}})
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
                    @foreach($comment as $k)
                        <div class="comment">
                            <a class="avatar">
                                <img src="{{$k->users->avatar or url('img/avatar/default/avatar.png')}}">
                            </a>
                            <div class="content">
                                <a class="author">{{$k->users->nickname}}
                                    <a href="" style="color: #3587ff">
                                        @ {{$k->replyedUsers->nickname}}
                                    </a>
                                </a>
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

@section('js')
    <script>
        function deleteTopic(context, artical_id, topic_id) {
            var apiUrl = "{{url('admin/topic')}}" + '/' + artical_id
            var _this = $(context)

            $.ajax({
                type: "DELETE",
                url: apiUrl,
                data: {topic_id: topic_id},
                success: function (data) {
                    if (data.code === 1) {
                        _this.parent().remove()
                        swal("干得漂亮！", "新增管理员成功", "success")
                    } else {
                        alert(data.info)
                    }
                    console.log(data)
                },
                error: function (e) {
                    console.log(e.responseText);
                },
                beforeSend: function () {

                }
            })
        }

        //切换状态


        var apiUrl = "{{url('admin/topic/change/status')}}"

        function checkOk(context, id) {
            var _this = $(context)
            $.ajax({
                type: "POST",
                url: apiUrl,
                data: {id: id, action: 'checkOk'},
                success: function (data) {
                    if (data.code === 1) {
                        swal(":)", "更新成功,当前状态", "success")
                    } else {
                        alert(data.info)
                    }
                    console.log(data)
                },
                error: function (e) {
                    console.log(e.responseText);
                },
                beforeSend: function () {

                }
            })
        }

        function checkNo(context, id) {
            var _this = $(context)
            $.ajax({
                type: "POST",
                url: apiUrl,
                data: {id: id, action: 'checkNo'},
                success: function (data) {
                    if (data.code === 1) {
                        swal(":)", "更新成功,当前状态", "success")
                    } else {
                        alert(data.info)
                    }
                    console.log(data)
                },
                error: function (e) {
                    console.log(e.responseText);
                },
                beforeSend: function () {

                }
            })
        }

        function block(context, id) {
            var _this = $(context)
            $.ajax({
                type: "POST",
                url: apiUrl,
                data: {id: id, action: 'block'},
                success: function (data) {
                    if (data.code === 1) {
                        swal(":)", "更新成功,当前状态", "success")
                    } else {
                        alert(data.info)
                    }
                    console.log(data)
                },
                error: function (e) {
                    console.log(e.responseText);
                },
                beforeSend: function () {

                }
            })
        }

        function cancelBlock(context, id) {
            $.ajax({
                type: "POST",
                url: apiUrl,
                data: {id: id, action: 'cancelBlock'},
                success: function (data) {
                    if (data.code === 1) {
                        swal(":)", "更新成功,当前状态", "success")
                    } else {
                        alert(data.info)
                    }
                    console.log(data)
                },
                error: function (e) {
                    console.log(e.responseText);
                },
                beforeSend: function () {

                }
            })
        }
    </script>
@endsection