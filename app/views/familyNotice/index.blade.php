@extends('adminLayout')

@section('content')
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">家族公告</strong> / <small>Notice</small></div>
      </div>

      <hr>

      <div class="am-g">
          <form class="am-form-inline" action="">
            <div class="am-u-sm-12 am-u-md-6">
              <div class="am-btn-toolbar">
                <div class="am-btn-group am-btn-group-xs">
                  <a type="button" class="am-btn am-btn-primary" href="{{url('familyNotice/edit')}}"><span class="am-icon-plus"></span> 新增</a>
                  {{--<button type="button" class="am-btn am-btn-default"><span class="am-icon-save"></span> 保存</button>--}}
                  {{--<button type="button" class="am-btn am-btn-default"><span class="am-icon-archive"></span> 审核</button>--}}
                  {{--<button type="button" class="am-btn am-btn-default"><span class="am-icon-trash-o"></span> 删除</button>--}}
                </div>
              </div>
            </div>
            {{--<div class="am-u-sm-12 am-u-md-3">--}}
              {{--<div class="am-form-group">--}}
                {{--<select class="am-form-field" data-am-selected="{btnSize: 'sm'}" style="display: none;">--}}
                  {{--<option value="option1">所有类别</option>--}}
                  {{--<option value="option2">IT业界</option>--}}
                  {{--<option value="option3">数码产品</option>--}}
                  {{--<option value="option3">笔记本电脑</option>--}}
                  {{--<option value="option3">平板电脑</option>--}}
                  {{--<option value="option3">只能手机</option>--}}
                  {{--<option value="option3">超极本</option>--}}
                {{--</select>--}}
              {{--</div>--}}
            {{--</div>--}}
            {{--<div class="am-u-sm-12 am-u-md-3">--}}
              {{--<div class="am-input-group am-input-group-sm">--}}
                {{--<input type="text" class="am-form-field">--}}
              {{--<span class="am-input-group-btn">--}}
                {{--<button class="am-btn am-btn-default" type="button">搜索</button>--}}
              {{--</span>--}}
              {{--</div>--}}
            {{--</div>--}}
            </form>
      </div>

      <div class="am-g">
        <div class="am-u-sm-12">
          <form class="am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
              <thead>
              <tr>
                <th class="table-check"><input type="checkbox"></th>
                <th class="table-id">ID</th><th class="table-title">标题</th>
                <th class="table-type">类别</th>
                <th class="table-author am-hide-sm-only">作者</th>
                <th class="table-date am-hide-sm-only">修改日期</th>
                <th class="table-set">操作</th>
              </tr>
              </thead>
              <tbody>
              @forelse($notice_list as $notice)
              <tr>
                <td><input type="checkbox"></td>
                <td>{{$notice->id}}</td>
                <td><a href="#">{{$notice->title}}</a></td>
                <td>default</td>
                <td class="am-hide-sm-only">{{$notice->author}}</td>
                <td class="am-hide-sm-only">{{$notice->updated_at}}</td>
                <td>
                  <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                      <a href="{{url('familyNotice/edit?id='.$notice->id)}}" class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span> 编辑</a>
                      <a href="{{url('familyNotice/drop?id='.$notice->id)}}" class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span> 删除</a>
                    </div>
                  </div>
                </td>
              </tr>
                @empty
                <tr>
                  <td colspan="7">您目前还没有家庭公告！<a type="button" class="am-btn am-btn-xs am-btn-primary" href="{{url('familyNotice/edit')}}"><span class="am-icon-plus"></span> 新增</a> </td>
                </tr>
                @endforelse
              </tbody>
            </table>
            <div class="am-cf">
                {{--共 {{$notice_list->count()}} 条记录--}}
                <div class="am-fr">
                    {{$notice_list->links()}}
                </div>
            </div>
          </form>
        </div>

      </div>
    </div>

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2017 powered by family tree</p>
    </footer>
@stop