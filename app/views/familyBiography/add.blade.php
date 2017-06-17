@extends('adminLayout')


@section('content')
<style type="text/css">
.editor{cursor:pointer;}
</style>
<div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">家族传记</strong> / <small>Biography</small></div>
      </div>

      <hr>

      <div class="am-g">
        <div class="am-u-sm-12">
          <div class="am-u-md-6">
            <div class="am-cf">
                <div class="am-fl am-cf"><span class="am-text-primary  am-text-lg">模板工具</span></div>
            </div>
            <hr/>
            <div data-am-widget="tabs" class="am-tabs am-tabs-default" data-am-tabs="{noSwipe: 1}" id="templates">
              <ul class="am-tabs-nav am-cf">
                <li class="am-active"><a href="javascript: void(0)">标题</a></li>
                <li><a href="javascript: void(0)">内容</a></li>
                <li><a href="javascript: void(0)">图文</a></li>
                <li><a href="javascript: void(0)">背景</a></li>
              </ul>
            
              <div class="am-tabs-bd">
                <div class="am-tab-panel am-pre-scrollable am-active">
                    @foreach($template_list as $template)
                    @if($template->type==1)
                        <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">{{$template->section}}</div>
                        </div>
                    @endif
                  @endforeach
                </div>
                <div class="am-tab-panel am-pre-scrollable">
                  @foreach($template_list as $template)
                      @if($template->type==2)
                          <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">{{$template->section}}</div>
                        </div>
                      @endif
                    @endforeach
                </div>
                <div class="am-tab-panel am-pre-scrollable">
                   @foreach($template_list as $template)
                    @if($template->type==3)
                        <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">{{$template->section}}</div>
                        </div>
                    @endif
                  @endforeach
                </div>
                <div class="am-tab-panel am-pre-scrollable">
                   @foreach($template_list as $template)
                    @if($template->type==4)
                        <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">{{$template->section}}</div>
                        </div>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <div class="am-u-md-6">
            <form class="am-form">
              <fieldset>
                <legend>添加传记</legend>
            
                {{--<div class="am-form-group">--}}
                  {{--<input type="email" class="" id="doc-ipt-email-1" placeholder="标题">--}}
                {{--</div>--}}
            {{----}}
                {{--<div class="am-form-group">--}}
                  {{--<label for="doc-select-1">分类</label>--}}
                  {{--<select id="doc-select-1">--}}
                    {{--<option value="option1">选项一</option>--}}
                    {{--<option value="option2">选项二<option>--}}
                    {{--<option value="option3">选项三</option>--}}
                  {{--</select>--}}
                  {{--<span class="am-form-caret"></span>--}}
                {{--</div>--}}
            
                <div class="am-form-group">
                  <label for="doc-ta-1">内容</label>
                  <div class="am-panel am-panel-default">
                      <div class="am-panel-bd" id="textarea" contenteditable="true">点击编辑</div>
                  </div>
                </div>
            
                <p><button type="submit" class="am-btn am-btn-default">提交</button></p>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2017 powered by family tree</p>
    </footer>
  </div>
@stop

@section('js')
<script type="text/javascript">
$(function(){
    $('#templates').find('section.editor').click(function(){
        console.log($(this).prop('outerHTML'));
        if($('#textarea').text() == '点击编辑'){
            $('#textarea').html($(this).prop('outerHTML'));
        }else{
            $('#textarea').append($(this).prop('outerHTML'));
        }
//        $(this).index(0).outerHTML();
    });
});
</script>
@stop