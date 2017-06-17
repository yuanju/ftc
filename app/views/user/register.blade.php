@extends('frontLayout')


@section('body')
<div class="header">
  <div class="am-g">
    <h1>Family tree</h1>
    <p>让每个人都可以参与家普制作！</p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <h3>注册</h3>
    <hr>
    {{ Form::open(array('url' => 'doRegister', 'method'=>'post', 'class'=>'am-form')) }}
      {{ Form::label('mobile', '手机:') }}
      {{ Form::text('mobile')  }}
      <br>
      {{ Form::label('密码:') }}
      {{ Form::password('password') }}
      <br>
      {{ Form::label('重复密码:') }}
      {{ Form::password('password_confirmation') }}
      <br />
      <div class="am-cf">
        <input type="submit" name="" value="注 册" class="am-btn am-btn-primary am-btn-sm am-fl">
        {{--<div class="am-btn-group am-fr">--}}
          {{--<a href="#" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-weixin am-icon-sm"></i> 微信</a>--}}
          {{--<a href="#" class="am-btn am-btn-success am-btn-sm"><i class="am-icon-weibo am-icon-sm"></i> 微博</a>--}}
        {{--</div>--}}
      </div>
    {{ Form::close() }}
  </div>
    <hr>
      <p class="am-padding-left">© powered by family tree chart.</p>
</div>
@stop