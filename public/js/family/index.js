/**
 * Created by Administrator on 2017/6/4.
 */
//节点框尺寸
var node_box_size = {width: 40, height: 40};
//节点尺寸， (节点框+节点连线)
var node_size = [50,100];
var data = {
    "name": "flare",
    "children": [
        {
            "name": "analytics",
            "children": [
                {
                    "name": "cluster",
                    "children": [
                        {"name": "AgglomerativeCluster"},
                        {
                            "name": "CommunityStructure",
                            "children": [
                                {"name": "AgglomerativeCluster"},
                                {
                                    "name": "CommunityStructure",
                                    "children": [
                                        {"name": "AgglomerativeCluster"},
                                        {"name": "CommunityStructure"},
                                        {"name": "HierarchicalCluster"},
                                        {"name": "MergeEdge"},
                                    ]
                                }
                            ]
                        },
                    ]
                },
                {
                    'name': 'qi',
                    'children': [
                        {'name': 'yuan'},
                        {'name': 'ju'}
                    ]
                }
            ]
        },
        {
            'name': 'test',
            'children': [
                {
                    "name": "MergeEdge",
                    'children': [
                        {
                            "name": "MergeEdge",
                            'children': [
                                {"name": "HierarchicalCluster"},
                                {"name": "MergeEdge"},
                                {"name": "HierarchicalCluster"}
                            ]
                        },
                        {"name": "HierarchicalCluster"},
                        {"name": "MergeEdge"}
                    ]
                },
                {"name": "MergeEdge"}
            ]
        },
        {
            'name': 'test',
            'children': [
                {"name": "HierarchicalCluster"},
                {
                    "name": "MergeEdge",
                    'children': [
                        {"name": "HierarchicalCluster"},
                        {"name": "MergeEdge"},
                        {
                            "name": "MergeEdge",
                            'children': [
                                {"name": "HierarchicalCluster"},
                                {"name": "MergeEdge"},
                                {"name": "HierarchicalCluster"}
                            ]
                        }
                    ]
                }
            ]
        },
        {
            'name': 'test',
            'children': [
                {"name": "HierarchicalCluster"},
                {"name": "MergeEdge"},
                {"name": "HierarchicalCluster"},
                {"name": "MergeEdge"},
            ]
        }
    ]
};
$(function(){

    var tree = d3.tree().nodeSize(node_size);
    var t = tree(d3.hierarchy(data));
    var link_gen = d3.linkVertical().source(function (d) { var source = $.extend({}, d.source); source.y += node_box_size.height; return source; }).x(function (d) { return d.x }).y(function (d) { return d.y });
    var descendants = t.descendants()
    var x_offset = d3.extent(descendants,function(d){ return d.x;});
    var y_max_offset = d3.max(descendants,function(d){ return d.y;});
    var x_min_offset = x_offset[0];
    var x_max_offset = x_offset[1];
    stage = new Kinetic.Stage({
        width: x_max_offset-x_min_offset+node_box_size.width,
        height: y_max_offset+node_box_size.height,
        container: 'stage'
    });
    layer_rect = new Kinetic.Layer({
        x: - x_min_offset
    });
    layer_link = new Kinetic.Layer({
        x: - x_min_offset + node_box_size.width/2
    });
    rect = null;
    descendants.forEach(function(d){
        rect = new Kinetic.Rect({
            x:d.x,
            y:d.y,
            width:node_box_size.width,
            height:node_box_size.height,
            fill:'#0e90d2',
            draggable:true
        })
        layer_rect.add(rect);
    });
    t.links().forEach(function(d){
        console.log(d);
        link_data_item = d;
        link = new Kinetic.Path({
            data: link_gen(d),
            stroke: 'black'
        });
        layer_link.add(link);
    });
    stage.add(layer_rect);
    stage.add(layer_link);
    
    
    
    rect.on('dragmove',function(){
        link_data_item.target.x = this.x();
        link_data_item.target.y = this.y();
        link.data(link_gen(link_data_item));
        layer_link.draw();
    });
    //descendants.forEach(function(d){
    //    context.beginPath();
    //    context.rect(d.x - x_min_offset, d.y, node_box_size.width, node_box_size.height);
    //    context.fillStyle="#0e90d2";
    //    context.fill();
    //    context.closePath();
    //});
    //t.links().forEach(function(d){
    //    var path = link(d);
    //    var path = path.split('C');
    //    context.beginPath();
    //    var move_to = path[0].substr(1).split(',');
    //    var curve_to = path[1].split(',');
    //    move_to[0] -= x_min_offset-node_box_size.width/2;
    //    for(var i in curve_to){
    //        if(i%2 == 0){
    //            curve_to[i] -= x_min_offset-node_box_size.width/2;
    //        }
    //    }
    //    context.strokeStyle="black";
    //    context.moveTo.apply(context, move_to);
    //    context.bezierCurveTo.apply(context, curve_to);
    //    context.stroke();
    //});

    $(".admin-content").mCustomScrollbar();
});