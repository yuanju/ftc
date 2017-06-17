<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>Family tree</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="alternate icon" type="image/png" href="{{ asset('i') }}/favicon.png">
  <link rel="stylesheet" href="{{ asset('css') }}/amazeui.min.css"/>
  <script type="text/javascript" src="{{ asset('js') }}/jquery.min.js"></script>
  <script type="text/javascript" src="{{ asset('js') }}/amazeui.min.js"></script>
  <style>
    .header {
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color: #333;
      margin-top: 30px;
    }
    .header p {
      font-size: 14px;
    }
  </style>
</head>
<body>

@if( Session::get('info_message') )
<div class="am-alert" data-am-alert>
<button type="button" class="am-close">&times;</button>
<p>{{ Session::get('info_message') }}</p>
</div>
<script type="text/javascript">
$(function(){
    setTimeout(function(){
        $('.am-alert').alert('close');
    }, 3000)
});
</script>
@endif

@if( Session::get('success_message') )
<div class="am-alert am-alert-success" data-am-alert>
<button type="button" class="am-close">&times;</button>
<p>{{ Session::get('success_message') }}</p>
</div>
<script type="text/javascript">
$(function(){
    setTimeout(function(){
        $('.am-alert').alert('close');
    }, 3000)
});
</script>
@endif

@if( Session::get('warning_message') )
<div class="am-alert am-alert-warning" data-am-alert>
<button type="button" class="am-close">&times;</button>
<p>{{ Session::get('warning_message') }}</p>
</div>
<script type="text/javascript">
$(function(){
    setTimeout(function(){
        $('.am-alert').alert('close');
    }, 3000)
});
</script>
@endif

@if( Session::get('danger_message') )
<div class="am-alert am-alert-danger" data-am-alert>
<button type="button" class="am-close">&times;</button>
<p>{{ Session::get('danger_message') }}</p>
</div>
<script type="text/javascript">
$(function(){
    setTimeout(function(){
        $('.am-alert').alert('close');
    }, 3000)
});
</script>
@endif

    @yield('body')
</body>
</html>
