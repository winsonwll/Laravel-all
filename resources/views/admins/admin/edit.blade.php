@extends('admins.master.base')

@section('title','管理员修改 - 管理员管理 - Piao.com管理后台')
@section('css')
    <link href="{{asset('admins/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>管理员修改</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" action="/admin/admin/{{ $res->aid }}" method="post" enctype="multipart/form-data">
                        @if(count($errors) > 0)
                            <div class="alert alert-warning alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户名：</label>
                            <div class="col-sm-5">
                                <input name="aname" class="form-control" type="text" value="{{ $res->aname  }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">权限：</label>
                            <div class="col-sm-5">
                                <div class="radio i-checks radio-inline">
                                    <label>
                                        <input type="radio" value="1" name="auth" {{ $res->auth=='1' ? 'checked' : '' }}> <i></i> 普通管理员
                                    </label>
                                </div>
                                <div class="radio i-checks radio-inline">
                                    <label>
                                        <input type="radio" value="2" name="auth" {{ $res->auth=='2' ? 'checked' : '' }}> <i></i> 超级管理员
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">头像：</label>
                            <div class="col-sm-5">
                                <div>
                                    <img src="{{ URL($res->face) }}" width="64">
                                </div>
                                <div id="file-pretty" class="m-t">
                                    <input type="file" name="face" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-lg">
                            <div class="col-sm-5 col-sm-offset-3">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <button class="btn btn-primary" type="submit">确认修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('admins/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('admins/js/plugins/prettyfile/bootstrap-prettyfile.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(".i-checks").iCheck({
                checkboxClass:"icheckbox_square-green",
                radioClass:"iradio_square-green"
            });
            $( 'input[type="file"]' ).prettyFile();
        });
    </script>
@endsection
