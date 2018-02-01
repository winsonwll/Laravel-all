@extends('admins.master.base')

@section('title','场馆修改 - 场馆管理 - Piao.com管理后台')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>场馆修改</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" action="{{ URL('/admin/venue/'.$res->vid) }}" method="post">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">场馆名称：</label>
                            <div class="col-sm-5">
                                <input name="vname" class="form-control" type="text" value="{{ $res->vname  }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">场馆城市：</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="vcity">
                                    <option value="">--请选择--</option>
                                    <option value="北京" {{ ($res->vcity == '北京') ? 'selected' : '' }}>北京</option>
                                    <option value="上海" {{ ($res->vcity == '上海') ? 'selected' : '' }}>上海</option>
                                    <option value="广州" {{ ($res->vcity == '广州') ? 'selected' : '' }}>广州</option>
                                    <option value="深圳" {{ ($res->vcity == '深圳') ? 'selected' : '' }}>深圳</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">场馆地址：</label>
                            <div class="col-sm-5">
                                <input name="vaddr" class="form-control" type="text" value="{{ $res->vaddr  }}">
                            </div>
                        </div>
                        <div class="form-group m-t-lg">
                            <div class="col-sm-5 col-sm-offset-3">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <input type="hidden" name="vid" value="{{ $res->vid }}">
                                <button class="btn btn-primary" type="submit">确认修改</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
