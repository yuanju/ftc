@extends('adminLayout')


@section('content')
    <style type="text/css">
        .editor {
            cursor: pointer;
            text-align:left;
        }
    </style>
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="am-cf am-padding am-padding-bottom-0">
                <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">@if($id)编辑@else添加@endif传记</strong> /
                    <small>Biography</small>
                </div>
            </div>

            <hr>

            <div class="am-g">
                <div class="am-u-sm-12 am-u-md-6 am-u-md-offset-3">
                    <form class="am-form" action="{{url('familyBiography/doEdit')}}" method="post">
                        <fieldset>
                            <div class="am-form-group">
                                <input type="hidden" name="id" value="@if($article){{$article->id}}@endif"/>
                                <input type="text" name='title' value="@if($article){{stripslashes($article->title)}}@endif" placeholder="标题">
                            </div>

                            {{--<div class="am-form-group">--}}
                                {{--<label for="doc-select-1">分类</label>--}}
                                {{--<select id="doc-select-1">--}}
                                    {{--<option value="option1">选项一</option>--}}
                                    {{--<option value="option2">选项二--}}
                                    {{--<option>--}}
                                    {{--<option value="option3">选项三</option>--}}
                                {{--</select>--}}
                                {{--<span class="am-form-caret"></span>--}}
                            {{--</div>--}}

                            <div class="am-form-group">
                                <textarea name="content" id="content" cols="30" rows="10" style="display: none;">
                                    @if($article){{stripslashes($article->content)}}@endif
                                </textarea>
                                <label for="doc-ta-1">内容</label>
                                <div class="am-panel am-panel-default">
                                    <div class="am-panel-bd" id="textarea">
                                        @if($article){{stripslashes($article->content)}}@endif
                                    </div>
                                    <div class="am-panel-bd" id="textarea">
                                        <button
                                                type="button"
                                                class="am-btn am-btn-primary"
                                                data-am-modal="{target: '#doc-modal-1', closeViaDimmer: 0, width: 500, height: 450}">
                                            添加
                                        </button>    
                                    </div>
                                </div>
                            </div>

                            <p>
                                <button type="submit" class="am-btn am-btn-default">保存</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        {{--模板素材--}}
        <div class="am-modal am-modal-no-btn" tabindex="-1" id="doc-modal-1">
            <div class="am-modal-dialog">
                <div class="am-modal-hd">选择素材
                    <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                </div>
                <div class="am-modal-bd">
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
                                        <div class="am-panel am-panel-default" id="section_{{$template->id}}">
                                            <div class="am-panel-bd">{{$template->section}}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="am-tab-panel am-pre-scrollable">
                                @foreach($template_list as $template)
                                    @if($template->type==2)
                                        <div class="am-panel am-panel-default" id="section_{{$template->id}}">
                                            <div class="am-panel-bd">{{$template->section}}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="am-tab-panel am-pre-scrollable">
                                @foreach($template_list as $template)
                                    @if($template->type==3)
                                        <div class="am-panel am-panel-default" id="section_{{$template->id}}">
                                            <div class="am-panel-bd">{{$template->section}}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="am-tab-panel am-pre-scrollable">
                                @foreach($template_list as $template)
                                    @if($template->type==4)
                                        <div class="am-panel am-panel-default" id="section_{{$template->id}}">
                                            <div class="am-panel-bd">{{$template->section}}</div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="am-modal" id="edit-section">
            <div class="am-modal-dialog">
                <div class="am-modal-hd">
                    修改文字
                    <a href="javascript:void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
                </div>
                <div class="am-modal-bd">
                    <div class="am-form">
                        <div class="am-form-group">
                            <textarea name="section-edit-text" id="section-edit-text" cols="30" rows="5"></textarea>
                            <input type="hidden" name="id"/>
                        </div>
                        {{--<div class="am-form-group">--}}
                            {{--<div class="am-btn-group-xs">--}}
                                {{--<button type="button" class="am-btn am-btn-default">换行符</button>--}}
                                {{--<button type="button" class="am-btn am-btn-default"></button>--}}
                                {{--<button type="button" class="am-btn am-btn-default"></button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    
                </div>
                <div class="am-modal-footer">
                    <div class="am-modal-btn" data-am-modal-confirm>保存</div>
                    <div class="am-modal-btn" data-am-modal-cancel>取消</div>
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
        String.prototype.replaceAll  = function(s1,s2){
            return this.replace(new RegExp(s1,"gm"),s2);
        };
        $(function () {
            $('#templates').find('section.editor').click(function () {
                $('#textarea').append($(this).prop('outerHTML'));
                var html = $('#textarea').html();
                $('#content').val(html);
                $('#doc-modal-1').modal('close');
            });
            $('#textarea').on('click', '.editable', function(){
                var obj_node = $(this);
                if(obj_node.attr('type') == 'text'){
                    $("#section-edit-text").val(obj_node.html().replaceAll('<br>', "\n"));
                }
                $('#edit-section').modal({
                    relatedTarget: this,
                    onConfirm: function(options) {
                        $(this.relatedTarget).html($("#section-edit-text").val().replaceAll("\n", '<br>'));
                        $('#content').val($('#textarea').html());
                    },
                    onCancel: function() {
                        this.close();
                    }
                });
            });
        });
    </script>
@stop