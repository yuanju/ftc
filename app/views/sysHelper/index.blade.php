@extends('adminLayout')


@section('content')
  <div data-am-widget="list_news" class="am-list-news am-list-news-default" >
    <div class="am-list-news-hd am-cf">
      <a href="##" class="">
        <h2>系统帮助</h2>
        {{--<span class="am-list-news-more am-fr">更多 &raquo;</span>--}}
      </a>
    </div>
    <div class="am-list-news-bd">
      <ul class="am-list">
        @foreach($helper_list as $helper)
        <li class="am-g am-list-item-dated">
          <a href="#" class="am-list-item-hd ">{{$helper->title}}</a>
          <span class="am-list-date">{{date('Y-m-d', strtotime($helper->updated_at))}}</span>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
@stop