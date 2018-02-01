@extends('admins.master.base')

@section('title','类别修改 - 类别管理 - Piao.com管理后台')
@section('css')
    <link href="{{asset('admins/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>类别修改</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" action="{{ URL('/admin/cate/'.$res->cid) }}" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">父级分类：</label>
                            <div class="col-sm-5">
                                <select class="form-control m-b" name="pid">
                                    <option value="0">--请选择--</option>
                                    @foreach($cates as $v)
                                        <option value="{{ $v->cid }}" @if($v->cid == $res->pid)
                                                selected
                                                @endif>{{ $v->cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">类别名称：</label>
                            <div class="col-sm-5">
                                <input name="cname" class="form-control" type="text" value="{{ $res->cname }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">状态：</label>
                            <div class="col-sm-5">
                                <div class="radio i-checks radio-inline">
                                    <label>
                                        <input type="radio" value="1" name="status" {{ $res->status=='1' ? 'checked' : '' }}> <i></i> 上线
                                    </label>
                                </div>
                                <div class="radio i-checks radio-inline">
                                    <label>
                                        <input type="radio" value="2" name="status" {{ $res->status=='2' ? 'checked' : '' }}> <i></i> 下线
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-lg">
                            <div class="col-sm-5 col-sm-offset-3">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="cid" value="{{ $res->cid }}">
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
    <script>
        $(document).ready(function(){
            $(".i-checks").iCheck({
                checkboxClass:"icheckbox_square-green",
                radioClass:"iradio_square-green"
            });
        });
    </script>
@endsection