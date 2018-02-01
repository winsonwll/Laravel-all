    @extends('admins.master.base')

    @section('title','Piao.com管理后台 - 登录')

    @section('css')
        <link href="{{asset('admins/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
        <link href="{{asset('admins/css/plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    @endsection

    @section('content')
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>自定义响应式表格</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="table_basic.html#">选项1</a>
                                </li>
                                <li><a href="table_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-5 m-b-xs">
                                <select class="input-sm form-control input-s-sm inline">
                                    <option value="0">请选择</option>
                                    <option value="1">选项1</option>
                                    <option value="2">选项2</option>
                                    <option value="3">选项3</option>
                                </select>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div data-toggle="buttons" class="btn-group">
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option1" name="options">天</label>
                                    <label class="btn btn-sm btn-white active">
                                        <input type="radio" id="option2" name="options">周</label>
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" id="option3" name="options">月</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th></th>
                                    <th>项目</th>
                                    <th>进度</th>
                                    <th>任务</th>
                                    <th>日期</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <input type="checkbox" checked class="i-checks" name="input[]">
                                    </td>
                                    <td>米莫说｜MiMO Show</td>
                                    <td><span class="pie">0.52/1.561</span>
                                    </td>
                                    <td>20%</td>
                                    <td>2014.11.11</td>
                                    <td>
                                        <div class="btn-group hidden-xs" id="exampleTableEventsToolbar" role="group">
                                            <button type="button" class="btn btn-outline btn-default">
                                                <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline btn-default">
                                                <i class="glyphicon glyphicon-heart" aria-hidden="true"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline btn-default">
                                                <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <input type="checkbox" class="i-checks" name="input[]">
                                    </td>
                                    <td>商家与购物用户的交互试衣应用</td>
                                    <td><span class="pie">6,9</span>
                                    </td>
                                    <td>40%</td>
                                    <td>2014.11.11</td>
                                    <td><a href="table_basic.html#"><i class="fa fa-check text-navy"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('js')
        <script src="{{asset('admins/js/plugins/peity/jquery.peity.min.js')}}"></script>
        <script src="{{asset('admins/js/plugins/iCheck/icheck.min.js')}}"></script>
        <script src="{{asset('admins/js/demo/peity-demo.min.js')}}"></script>
        <script>
            $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green"})});
        </script>
    @endsection