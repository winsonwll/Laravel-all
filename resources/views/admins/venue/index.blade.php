@extends('admins.master.base')

@section('title','场馆列表 - 场馆管理 - Piao.com管理后台')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>场馆列表</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ URL('/admin/venue/') }}" method="post" class="hidden" name="myform">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                    </form>
                    <a href="{{ URL('/admin/venue/create') }}" class="btn btn-primary ">添加场馆</a>
                    <div class="row">
                        <form action="{{ URL('/admin/venue') }}" method="get">
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
                            <th>场馆名称</th>
                            <th>场馆城市</th>
                            <th>场馆地址</th>
                            <th>操作</th>
                        </tr>
                        @foreach( $list as $v)
                            <tr>
                                <td>{{ $v->vid }}</td>
                                <td>{{ $v->vname }}</td>
                                <td>{{ $v->vcity }}</td>
                                <td>{{ $v->vaddr }}</td>
                                <td>
                                    <a href="{{ URL('/admin/venue/'.$v->vid.'/edit') }}" class="btn btn-primary">修改</a>
                                    <a href="javascript:;" data-id="{{ $v->vid }}" class="btn btn-default m-l-xs">删除</a>
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
                    $('form[name=myform]').attr('action','/admin/venue/'+self.attr('data-id'));
                    $('form[name=myform]').submit();
                }
            });
        });
    </script>
@endsection
