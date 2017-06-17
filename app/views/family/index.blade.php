@extends('adminLayout')

@section('css')
<style type="text/css">
    body {
        margin: 0;
    }
    .link {
        fill: none;
        stroke: #000;
        stroke-opacity: 0.4;
        stroke-width: 1.5px;
    }
    rect{
    fill:#0e90d2;
    }
    .admin-content{ }
    .admin-content #stage{ }
    .stage_container{position: relative;width:100%;height:100%;}
    #context-menu{ position: absolute; width:200px; height: 30px; background:black; display: none; border-radius: 5px; }
    #context-menu ul{display: block;padding:0;}
    #context-menu ul li{text-decoration: none;float:left;width:50px;color:#fff;list-style: none;text-align: center;line-height:30px;}
    #context-menu ul li.disabled{color:#8a8989;}
    #context-menu ul li em{float:right;height:20px;border-right:1px solid #000;width:1px;margin-top:5px;box-shadow: 1px 1px 1px ;}
</style>
@stop

@section('content')
<div class="admin-content"> 
    <div class="stage_container">
        <div class="stage" id="stage"></div>
        <div id="context-menu">
            <ul>
                <li class="add_parent" value="add_parent"><i class="am-icon-arrow-circle-up"></i><em></em></li>
                <li class="add_apart" value="add_apart"><i class="am-icon-users"></i><em></em></li>
                <li class="add_brother" value="add_brother"><i class="am-icon-arrow-circle-right"></i><em></em></li>
                <li class="add_son" value="add_son"><i class="am-icon-arrow-circle-down"></i></li>
            </ul>
        </div>
    </div>
{{--<canvas id="canvas"></canvas>--}}

</div>
@stop

@section('js')
<script type="text/javascript" src="{{asset('js')}}/jquery/jquery.mouseWheel.min.js"></script>
<script type="text/javascript" src="{{asset('js')}}/d3.v4.min.js"></script>
<script type="text/javascript" src="{{asset('js')}}/kinetic-v5.1.0.min.js"></script>
<script type="text/javascript" src="{{asset('js')}}/preloadJS/preloadjs-0.6.2.min.js"></script>
{{--<script type="text/javascript" src="{{asset('js/family')}}/index.js"></script>--}}
<script type="text/javascript" src="{{asset('js/family')}}/family_map.v3.js"></script>
<script type="text/javascript" src="{{asset('js/family')}}/family_map_config.js"></script>
<script type="text/javascript" src="{{asset('js/family')}}/test.v3.js"></script>
{{--<script type="text/javascript" src="{{asset('js/family')}}/family_contextmenu.js"></script>--}}
@stop