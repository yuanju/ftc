@extends('frontLayout')

@section('body')
<body>
<div class="header">
  <div class="am-g">
    <h1>Family tree</h1>
    <p>让每个人都可以参与家普制作！</p>
  </div>
  <hr />
</div>
<div class="am-g">
  <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
    <h3>登录</h3>
    <hr>
    <div class="am-btn-group">
      <a href="#" class="am-btn am-btn-secondary am-btn-sm"><i class="am-icon-weixin am-icon-sm"></i> 微信</a>
      <a href="#" class="am-btn am-btn-success am-btn-sm"><i class="am-icon-weibo am-icon-sm"></i> 微博</a>
    </div>
    <br>
    <br>
    {{ Form::open(array('url' => 'doLogin', 'method'=>'post', 'class'=>'am-form')) }}
      {{ Form::label('mobile', '手机:') }}
      {{ Form::text('mobile', Input::get('mobile'))  }}
      <br>
      {{ Form::label('密码:') }}
      {{ Form::password('password') }}
      <br>
      <label for="remember-me">
        {{--<input id="remember-me" type="checkbox">--}}
         {{ Form::checkbox('remember-me', 1, false, array('id'=>'remember-me'))  }}
        记住密码
      </label>
      <br />
      <div class="am-cf">
        <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
        <input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">
      </div>
      {{ Form::close() }}
  </div>
    <hr>
      <p class="am-padding-left">© powered by family tree chart.</p>
</div>
</body>
@stop