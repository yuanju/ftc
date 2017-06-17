var family_map = function (data,queue) {
    /**
     * 初始化
     * @private
     */
    this._init = function () {
        this.data = data;
        this.queue = queue;
        this.scale_number = 1;
        this.active_node;
        this.active_node_id;
        this.tree_layout = d3.tree().nodeSize(node_size);
        this.node_link_generater = d3.linkVertical().source(function (d) {
            var source = $.extend({}, d.source);
            source.y += node_box_size.height;
            return source;
        }).x(function (d) {
            return d.x
        }).y(function (d) {
            return d.y
        });
        var tree_layout_data = this.tree_layout(d3.hierarchy(this.data));
        this.node_data = tree_layout_data.descendants();
        this.link_data  = tree_layout_data.links();
        this.link_scale = d3.scaleLinear().domain(d3.extent(this.node_data,function(d){return d.depth;})).range([5,1]);
        var x_offset = d3.extent(this.node_data, function (d) {
            return d.x;
        });
        var y_max_offset = d3.max(this.node_data, function (d) {
            return d.y;
        });
        var x_min_offset = x_offset[0];
        var x_max_offset = x_offset[1];
        this.map_size = {
            width:x_max_offset - x_min_offset + node_box_size.width,
            height: y_max_offset + node_box_size.height
        };
        this.map_size.width = this.map_size.width < stage_size.width ? stage_size.width : this.map_size.width;
        this.map_size.height = this.map_size.height < stage_size.height ? stage_size.height : this.map_size.height;
        var _this = this;
        this.stage = new Kinetic.Stage({
            width: stage_size.width,
            height: stage_size.height,
            container: 'stage'
        });
        $('#stage').width(stage_size.width).height(stage_size.height);
        this.canvas = new Kinetic.Layer({
            name:'canvas'
        });
        this.map_container = new Kinetic.Group({
            x:-this.map_size.width/2,
            y:-this.map_size.height/2,
            width:this.map_size.width*2,
            height:this.map_size.height*2,
            draggable:true,
            name:'map_container'
        });
        this.map_background = new Kinetic.Rect({
            width:this.map_size.width*2,
            height:this.map_size.height*2,
            fill:'#fff',
            name:'map_background'
        });
        this.map_group = new Kinetic.Group({
            x:this.map_size.width/2 ,
            y:this.map_size.height/2,
            name:'map_group'
        });
        this.nodes_group = new Kinetic.Group({
            x:-x_min_offset,
            name:'nodes_group'
        });
        this.link_group = new Kinetic.Group({
            x: -x_min_offset + node_box_size.width / 2,
            name:'link_group'
        });
        this.canvas_background = new Kinetic.Rect({
            width: stage_size.width,
            height: stage_size.height,
            fill:'red',
            draggable:true
        });
        this.dom_container = d3.select('.stage');
        this.dom_container.selectAll('span.node')
            .data(this.node_data)
            .enter()
            .append('span')
            .attr('class', 'node')
            .property('kinetic.node', function (d) {
                return _this._get_new_node(d)
            });
        this.dom_container.selectAll('span.link')
            .data(this.link_data)
            .enter()
            .append('span')
            .attr('class', 'link')
            .property('kinetic.node', function (d) {
                return _this._get_new_link(d);
            });

        this.map_group.add(this.nodes_group);
        this.map_group.add(this.link_group);
        this.map_container.add(this.map_background);
        this.map_container.add(this.map_group);
        this.canvas.add(this.canvas_background);
        this.canvas.add(this.map_container);
        this.stage.add(this.canvas);
    };
    /**
     * 添加元素
     * @param id
     * @param member
     * @param _data
     * @private
     */
    this._data_add = function(id, member, _data){
        if(_data == undefined){
            _data = this.data;
        }
        if(_data.id == id){
            if(_data['children'] == undefined){
                _data['children'] = [member];
            }else{
                _data['children'].push(member);
            }
        }else{
            for(var i in _data.children){
                this._data_add(id, member, _data.children[i]);
            }
        }
    };
    /**
     * 删除元素
     * @param id
     * @param data
     * @returns {boolean}
     * @private
     */
    this._data_remove = function (id, data) {
        if (data.id == id) {
            if (data['children'] == undefined || data.children.length > 1) {
                return false;
            }
            this.data = data.children.pop();
            return true;
        }
        if (data['children'] == undefined) {
            return false;
        }
        var val = false;
        for (var i in data.children) {
            if (data.children[i].id == id) {
                var val = data.children[i];
            }
        }
        if (!val) {
            return false;
        }
        var index = data.children.indexOf(val);
        if (index > -1) {
            data.children.splice(index, 1);
            return true;
        }
        return false;
    };
    /**
     * 创建新结点
     * @param d
     * @returns {Kinetic.Rect}
     * @private
     */
    this._get_new_node = function (d) {
        var node_group = new Kinetic.Group({
            x: d.x,
            y: d.y,
            width: node_box_size.width,
            height: node_box_size.height,
            fill: '#429842',
            id: d.data.id,
            name:'node_group'
        });
        var node = new Kinetic.Rect({
            x: 0,
            y: 0,
            width: node_box_size.width,
            height: node_box_size.height,
            fill: '#429842'
        });
        var man_role_map = {
            0:'ageness_man',
            1:'mid_life_man',
            2:'mid_life_man',
            3:'boy'
        };
        var woman_role_map = {
            0:'ageness_woman',
            1:'mid_life_woman',
            2:'mid_life_woman',
            3:'girl'
        };
        var avatar01 = new Kinetic.Image({
            x:5,
            y:5,
            width:30,
            height:30,
            image:this.queue.getResult(man_role_map[1])
            });
        var avatar02 = new Kinetic.Image({
            x:(node_box_size.width/2)+5,
            y:5,
            width:30,
            height:30,
            image:queue.getResult(woman_role_map[1])
            });
        var text = new Kinetic.Text({
            fontSize:20,
            fill: '#FFFFFF',
            text: d.x
        });
        node_group.add(node);
        node_group.add(avatar01);
        node_group.add(avatar02);
        node_group.add(text);
        this.nodes_group.add(node_group);
        return node_group;
    };
    /**
     *  创建新结点连接
     * @param d
     * @returns {Kinetic.Path}
     * @private
     */
    this._get_new_link = function (d) {
        var link = new Kinetic.Path({
            data: this.node_link_generater(d),
            stroke: '#804d16',
            strokeWidth:this.link_scale(d.source.depth)
        });
        this.link_group.add(link);
        return link;
    };
    /**
     * 家普渲染
     */
    this.render = function (scale_number,offset) {
        if(scale_number == undefined){
            scale_object = {x:1,y:1};
        }else{
            scale_object = {x:scale_number, y:scale_number};
        }
        if(offset == undefined){
            offset = {x:0,y:0};
        }
        this.scale_number = scale_object.y;
        var tree_layout_data = this.tree_layout(d3.hierarchy(this.data));
        this.node_data = tree_layout_data.descendants()
        this.link_data = tree_layout_data.links();
        this.link_scale = d3.scaleLinear().domain(d3.extent(this.node_data,function(d){return d.depth;})).range([5,1]);
        var x_offset = d3.extent(this.node_data, function (d) {
            return d.x;
        });
        var y_max_offset = d3.max(this.node_data, function (d) {
            return d.y;
        });
        var x_min_offset = x_offset[0];
        var x_max_offset = x_offset[1];
        this.map_size = {
            width:x_max_offset - x_min_offset + node_box_size.width,
            height: y_max_offset + node_box_size.height
        };
        this.map_size.width = this.map_size.width < stage_size.width ? stage_size.width : this.map_size.width;
        this.map_size.height = this.map_size.height < stage_size.height ? stage_size.height : this.map_size.height;
        this.map_size.width = this.map_size.width;
        this.map_size.height = this.map_size.height;
        
        this.nodes_group.x(-x_min_offset);
        this.link_group.x(-x_min_offset + node_box_size.width / 2);
        this.map_container.width(this.map_size.width*2).height(this.map_size.height*2);
        //if(scale_object.x != 1){
        //    this.map_container.x(-this.map_size.width/2).y(-this.map_size.height/2);
        //}
        this.map_background.width(this.map_size.width*2).height(this.map_size.height*2);
        //######
        this.map_group.x(this.map_size.width/2).y(this.map_size.height/2);
        //####  
        //if(scale_number > 1){
        //    var map_container_width = this.map_size.width*scale_number
        //    var map_container_height = this.map_size.height*scale_number
        //    this.map_container.width(map_container_width).height(map_container_height);
        //    this.map_background.width(map_container_width).height(map_container_height);
        //    this.map_group.x(0).y(0);
        //    this.map_container.x(0).y(0);
        //}
        
        var _this = this;

        var nodes = this.dom_container.selectAll('span.node')
            .data(this.node_data)
            .property('kinetic.node', function (d) {
                var node = d3.select(this).property('kinetic.node').x(d.x).y(d.y);
                node.attrs.id = d.data.id;
                for(var i in node.children){
                    if(node.children[i].className == 'Text'){
                        node.children[i].text(d.x);
                    }
                }
                _this.active_decoration(d,node);
                return node;
            })
            .attr('class', 'node');
        nodes.enter()
            .append('span')
            .attr('class', 'node')
            .property('kinetic.node', function (d) {
                var node = _this._get_new_node(d);
                _this.active_decoration(d,node);
                return node;
            });
        nodes.exit()
            .property('kinetic.node', function (d) {
                d3.select(this).property('kinetic.node').x(d.x).y(d.y).remove();
            })
            .remove();

        var links = this.dom_container.selectAll('span.link')
            .data(this.link_data)
            .property('kinetic.node', function (d) {
                var node = d3.select(this).property('kinetic.node').data(_this.node_link_generater(d));
                node.strokeWidth(_this.link_scale(d.source.depth));
                return node;
            });
        links.enter()
            .append('span')
            .attr('class', 'link')
            .property('kinetic.node', function (d) {
                return _this._get_new_link(d)
            });
        links.exit()
            .property('kinetic.node', function (d) {
                d3.select(this).property('kinetic.node').remove();
            })
            .remove();
        //######
        var ofx = offset.x-(this.map_group.x()+this.map_container.x());
        var ofy = offset.y - (this.map_group.y()+this.map_container.y());
        console.log({x:ofx,y:ofy},this.scale_number);
        this.map_group.offset({x:ofx,y:ofy});
        if(this.scale_number != 1){
            this.map_group.x(this.map_group.x()+offset.x+(-this.map_size.width/2-this.map_container.x())).y(this.map_group.y()+offset.y+(-this.map_size.height/2-this.map_container.y()));
        }else{
            this.map_group.x(this.map_size.width/2).y(this.map_size.height/2);
            this.map_container.x(-this.map_size.width/2).y(-this.map_size.height/2);
        }
        //######
        this.map_group.scale(scale_object);
        
        //##############
        //var ofx = this.map_container.x() + offset.offsetX;
        //var ofy = this.map_container.y() + offset.offsetY;
        //console.log(offset,ofx, ofy);
        //this.map_container.scale(scale_object);
        //this.map_container.offset({x:ofx,y:ofx});
        //###########
        this.canvas.draw();
    };
    //修饰活跃的节点
    this.active_decoration = function(d, node){
        if(d.data.id != this.active_node_id){
            return;
        }
        node_group_control.setHighLight(node);
        node_group_control.setCenter(node);
    };
    //添加节点
    this.add_member = function (parent_id, member) {
        if(!parent_id || member['id'] == undefined){
            return false;
        }
        this._data_add(parent_id, member);
        this.active_node_id = parent_id;
        this.render();
    };
    //删除节点
    this.remove_member = function (id) {
        if(!id){
            return false;
        }
        this._data_remove(id, this.data);
        this.render();
    };
    //添加父节点
    this.add_parent_member = function (id, member) {
        if(!id || member['id'] == undefined){
            return false;
        }
        if(this.data.id != id){
            return false;
        }
        if(member['children'] == undefined){
            member['children'] = [this.data];
        }else{
            member.children.push(this.data);
        }
        this.data = member;
        this.active_node_id = id;
        this.render();
    };
    this.scale = function(scale_number,offset){
        this.render(scale_number,offset);
        console.log(this.map_container.x(),this.map_container.y());
        return;
    };
    this._init();
};



