@extends('admins.master.base')

@section('title','商品添加 - 商品管理 - Piao.com管理后台')
@section('css')
    <link href="{{asset('admins/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>商品添加</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" action="{{ URL('/admin/good') }}" method="post" enctype="multipart/form-data">
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
                            <label class="col-sm-3 control-label">商品名称：</label>
                            <div class="col-sm-5">
                                <input name="title" class="form-control" type="text" value="{{ old('title') }}" placeholder="请输入商品名称">
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">价格：</label>
                                <div class="col-sm-5">
                                    <input name="price" class="form-control" type="number" placeholder="请输入商品价格">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">库存：</label>
                                <div class="col-sm-5">
                                    <input name="cnt" class="form-control" type="number" placeholder="请输入商品库存">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">商品主图：</label>
                                <div class="col-sm-5">
                                    <div id="file-pretty">
                                        <input type="file" name="pic" class="form-control">
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商品类别：</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="cid">
                                    <option value="0">--请选择--</option>
                                    @foreach($cates as $v)
                                        <option value="{{ $v->cid }}">{{ $v->cname }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">颜色</label>
                                <div class="col-sm-10">
                                    <div class="checkbox i-checks">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="红色" name="color[]">红色</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="绿色" name="color[]">绿色</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="白色" name="color[]">白色</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="粉色" name="color[]">粉色</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="紫色" name="color[]">紫色</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">尺寸</label>
                                <div class="col-sm-10">
                                    <div class="checkbox i-checks">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="37" name="size[]">37</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="38" name="size[]">38</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="39" name="size[]">39</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="40" name="size[]">40</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="41" name="size[]">41</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="42" name="size[]">42</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="XL" name="size[]">XL</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="XXL" name="size[]">XXL</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="XXXL" name="size[]">XXXL</label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" value="L" name="size[]">L</label>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">状态：</label>
                            <div class="col-sm-5">
                                <div class="radio i-checks radio-inline">
                                    <label>
                                        <input type="radio" checked value="1" name="status"> <i></i> 上线
                                    </label>
                                </div>
                                <div class="radio i-checks radio-inline">
                                    <label>
                                        <input type="radio" value="2" name="status"> <i></i> 下线
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">商品详情：</label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-9">
                                <script id="editor" name="content" type="text/plain"></script>
                            </div>
                        </div>
                        <div class="form-group m-t-lg">
                            <div class="col-sm-5 col-sm-offset-3">
                                {{ csrf_field() }}
                                <button class="btn btn-primary" type="submit">确认添加</button>
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
    <script src="{{asset('admins/js/plugins/layer/laydate/laydate.js')}}"></script>
    <script src="{{asset('admins/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('admins/ueditor/ueditor.all.min.js')}}"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script src="{{asset('admins/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(".i-checks").iCheck({
                checkboxClass:"icheckbox_square-green",
                radioClass:"iradio_square-green"
            });
            $( 'input[type="file"]' ).prettyFile();
        });
        //实例化编辑器
        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
        var ue = UE.getEditor('editor');
    </script>
@endsection

