var node_group_control = {
    init:function(){
        ftc.stage.on('click',function(e){
            if(e.target.parent.attrs.name == 'node_group'){
                if(ftc.scale_number == 1){
                    node_group_control.setActive(e.target.parent);
                    contextMenu.show(e.target.parent);
                    return;
                }
                ftc.scale(1,{x:0,y:0});
                node_group_control.setCenter(e.target.parent);
                node_group_control.setActive(e.target.parent);
                contextMenu.show(e.target.parent);
            }else{
                contextMenu.hide();
            }
        });
    },
    setActive : function(node_group){
        this.setHighLight(node_group);
        ftc.active_node = node_group;
        ftc.render();
    },
    setHighLight : function(node_group){
        ftc.nodes_group.children.each(function(_node_group){
            _node_group.children.each(function(d){
                if(d.className == 'Rect'){
                    d.fill('#429842');
                }
            });
        });
        node_group.children.each(function(d){
            if(d.className == 'Rect'){
                d.fill('#F37B1D');
            }
        });
    },
    setCenter : function(node_group){
        var x = (stage_size.width/2 - node_box_size.width/2) - (ftc.map_size.width/2+node_group.x() + ftc.nodes_group.x());
        var y = stage_size.height/2 - (ftc.map_size.height/2 + node_group.y())  - node_box_size.height/2 - stage_size.height/4;
        x = x >= 0 ? 0 : x;
        x = x <= -ftc.map_container.width()+stage_size.width ? -ftc.map_container.width()+stage_size.width : x;
        y = y >= 0 ? 0 : y;
        y = y <= -ftc.map_container.height()+stage_size.height ? -ftc.map_container.height()+stage_size.height : y;
        ftc.map_container.x(x).y(y);
        ftc.active_node = node_group;
        ftc.active_node_id = node_group;
    }
};
var contextMenu = {
    node : null,
    width : 200,
    height : 30,
    init : function(){
        $('#context-menu li').click(function(){
            var btn_key = $(this).attr('value');
            var disabled = $(this).hasClass('disabled');
            if(disabled){
                console.log('false');
                return false;
            }
            switch (btn_key){
                case 'add_son':
                    contextMenu.add_son();
                    break;
                case 'add_parent':
                    contextMenu.add_parent();
                    break;
                case 'add_apart':
                    console.log('add_apart');
                    break;
                case 'add_brother':
                    console.log('add_brother');
                    break;
            }
        });
    },
    parentDisabled:function(){
        
    },
    show : function(node){
        contextMenu.node = node;
        var x = ftc.map_group.x() + node.x() + ftc.nodes_group.x() + ftc.map_container.x();
        var y = ftc.map_group.y() + node.y() + ftc.map_container.y() - 40;
        x = x<0 ? 0 :x;
        x = x>stage_size.width-this.width ? stage_size.width-this.width : x;
        y = y<0 ? 0 : y;
        y = y > stage_size.height-this.height ? stage_size.height-this.height : y;
        if(node.getAttr('data').parent == null){
            $('#context-menu').find('li.add_parent').removeClass('disabled');
            $('#context-menu').find('li.add_brother').addClass('disabled');
        }else{
            $('#context-menu').find('li.add_parent').addClass('disabled');
            $('#context-menu').find('li.add_brother').removeClass('disabled');
        }
        $('#context-menu').show().css({left:x,top:y});
    },
    hide : function() {
        $('#context-menu').hide();
    },
    //添加了节点
    add_son : function(){
        var parent_id = contextMenu.node.attrs.id;
        var max_id = d3.max(ftc.node_data, function(d){return d.data.id});
        ftc.add_member(parent_id, {id:max_id+1});
        this.hide();
    },
    //添加父节点
    add_parent : function(){
        var id = contextMenu.node.attrs.id;
        var max_id = d3.max(ftc.node_data, function(d){return d.data.id});
        ftc.add_parent_member(id, {id:max_id+1});
        this.hide();
    }
};

var page_drag = {
    init:function(){
        ftc.map_container.dragBoundFunc(page_drag.dragFunc);
    },
    dragFunc:function(e){
        e.x = e.x >= 0 ? 0 : e.x;
        e.x = e.x <= -ftc.map_container.width()+stage_size.width ? -ftc.map_container.width()+stage_size.width : e.x;
        e.y = e.y >= 0 ? 0 : e.y;
        e.y = e.y <= -ftc.map_container.height()+stage_size.height ? -ftc.map_container.height()+stage_size.height : e.y;
        return {
            x: e.x,
            y: e.y
        };
    }
};
   
$(function(){
    //image = new Image();
    //image.src='http://www.family.com/images/avatar/agedness_man_head.png';
    //image.onload  = function(){
    //    ftc = new family_map(data);
    //    //ftc.add_member(1,{id:6,name:'a'});
    //};
    var manifest = [
        {id:'ageness_man',src:'/images/avatar/agedness_man_head.png'} ,
        {id:'ageness_woman',src:'/images/avatar/agedness_woman_head.png'} ,
        {id:'mid_life_man',src:'/images/avatar/mid_life_man_head.png'} ,
        {id:'mid_life_woman',src:'/images/avatar/mid_life_woman_head.png'} ,
        {id:'boy',src:'/images/avatar/boy_head.png'} ,
        {id:'girl',src:'/images/avatar/girl_head.png'} 
    ];
    
    var queue = new createjs.LoadQueue();
    queue.loadManifest(manifest);
    queue.on("complete", function(){
        ftc = new family_map(data, queue);
        node_group_control.init();
        contextMenu.init();
        page_drag.init();
        //$('#stage').mousewheel(function(event) {
        //    var scale_number = ftc.scale_number+event.deltaY*0.1;
        //    scale_number = scale_number < 0.5 ? 0.5 : scale_number;
        //    scale_number = scale_number > 2 ? 2 : scale_number;
        //    console.log(scale_number,event);
        //    ftc.scale(scale_number+0.01,{x:event.offsetX,y:event.offsetY});
        //});
    });
});