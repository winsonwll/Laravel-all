@extends('admins.master.base')

@section('title','类别列表 - 类别管理 - Piao.com管理后台')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>类别列表</h5>
                </div>
                <div class="ibox-content">
                    <form action="{{ URL('/admin/cate/') }}" method="post" class="hidden" name="myform">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="delete">
                    </form>
                    <a href="{{ URL('/admin/cate/create') }}" class="btn btn-primary ">添加类别</a>
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th>序号</th>
                            <th>类别名称</th>
                            <th>pid</th>
                            <th>path</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        @foreach( $cates as $v)
                            <tr>
                                <td>{{ $v->cid }}</td>
                                <td>{{ $v->cname }}</td>
                                <td>{{ $v->pid }}</td>
                                <td>{{ $v->path }}</td>
                                <td>{{ ($v->status=='1') ? '上线' : '下线' }}</td>
                                <td>
                                    <a href="{{ URL('/admin/cate/'.$v->cid.'/edit') }}" class="btn btn-primary">修改</a>
                                    <a href="{{ URL('/admin/cate/create/'.$v->cid) }}" class="btn btn-primary m-l-xs">添加子类</a>
                                    <a href="javascript:;" data-id="{{ $v->cid }}" class="btn btn-default m-l-xs">删除</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
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
                    $('form[name=myform]').attr('action','/admin/cate/'+self.attr('data-id'));
                    $('form[name=myform]').submit();
                }
            });
        });
    </script>
@endsection
