@extends('admins.master.base')

@section('title','演出列表 - 演出管理 - Piao.com管理后台')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>演出列表</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ URL('/admin/show/') }}" method="post" class="hidden" name="myform">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                    </form>
                    <a href="{{ URL('/admin/show/create') }}" class="btn btn-primary ">添加演出</a>
                    <div class="row">
                        <form action="{{ URL('/admin/show') }}" method="get">
                        <div class="col-sm-9">
                            <div class="dataTables_length" id="editable_length">
                                <label>每页
                                    <select name="num" class="form-control input-sm">
                                        <option value="10" @if(!empty($request['num']) && $request['num']==10) selected @endif>10</option>
                                        <option value="25" @if(!empty($request['num']) && $request['num']==25) selected @endif>25</option>
                                        <option value="50" @if(!empty($request['num']) && $request['num']==50) selected @endif>50</option>
                                    </select> 条记录</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" placeholder="请输入关键词" class="input-sm form-control" name="keyword" value="{{ $request['keyword'] or '' }}">
                                <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button> </span>
                            </div>
                        </div>
                        </form>
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th>序号</th>
                            <th>演出名称</th>
                            <th>演出类别</th>
                            <th>演出时间</th>
                            <th>演出场馆</th>
                            <th>价格</th>
                            <th>库存</th>
                            <th>销量</th>
                            <th>浏览量</th>
                            <th>状态</th>
                            <th>演出海报</th>
                            <th>演出简介</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach( $list as $v)
                            <tr>
                                <td>{{ $v->sid }}</td>
                                <td>{{ $v->sname }}</td>
                                <td>{{ $v->cid }}</td>
                                <td>{{ $v->stime }}</td>
                                <td>{{ $v->vid }}</td>
                                <td>{{ $v->price }}</td>
                                <td>{{ $v->cnt }}</td>
                                <td>{{ $v->scnt }}</td>
                                <td>{{ $v->vcnt }}</td>
                                <td>
                                    @if ($v->status=='1')
                                        上线
                                    @elseif ($v->status=='2')
                                        下线
                                    @else
                                        特殊
                                    @endif
                                </td>
                                <td><img src="{{ URL($v->spic) }}"></td>
                                <td>{{ substr($v->sdesc,0,10).'....' }}</td>
                                <td>{{ $v->created_at }}</td>
                                <td>
                                    <a href="{{ URL('/admin/show/'.$v->sid.'/edit') }}" class="btn btn-primary">修改</a>
                                    <a href="javascript:;" data-id="{{ $v->sid }}" class="btn btn-default m-l-xs">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="row">
                        <div class="dataTables_paginate paging_simple_numbers">
                            {!! $list->appends($request)->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function(){
            $('.btn-default').click(function(){
                var self=$(this);
                if(confirm('确定要删除吗？')){
                    $('form[name=myform]').attr('action','/admin/show/'+self.attr('data-id'));
                    $('form[name=myform]').submit();
                }
            });
        });
    </script>
@endsection
