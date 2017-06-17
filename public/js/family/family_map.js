var family_map = function (data,queue) {
    /**
     * 初始化
     * @private
     */
    this._init = function () {
        this.data = data;
        this.queue = queue;
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
        this.link_scale = d3.scaleLinear().domain([0,3]).range([5,1]);
        var x_offset = d3.extent(this.node_data, function (d) {
            return d.x;
        });
        var y_max_offset = d3.max(this.node_data, function (d) {
            return d.y;
        });
        var x_min_offset = x_offset[0];
        var x_max_offset = x_offset[1];
        var _this = this;
        this.stage = new Kinetic.Stage({
            width: x_max_offset - x_min_offset + node_box_size.width,
            height: y_max_offset + node_box_size.height,
            container: 'stage'
        });
        $('#stage').width(x_max_offset - x_min_offset + node_box_size.width).height(y_max_offset + node_box_size.height);
        
        var background_layer = new Kinetic.Layer({
            x:0
        });
        var background_rect = new Kinetic.Rect({
            x:0,
            y:0,
            width: x_max_offset - x_min_offset + node_box_size.width,
            height: y_max_offset + node_box_size.height,
            fill:'#fff'
        });
        //var background_rect = new Kinetic.Rect({
        //    x:0,
        //    y:0,
        //    width:50,
        //    height: 50,
        //    fill:'#f00'
        //});
        background_layer.add(background_rect);
        //this.stage.offsetX(this.stage.width()).offsetY(this.stage.height());
        this.node_layer = new Kinetic.Layer({
            x: -x_min_offset
            //offset:[(x_max_offset - x_min_offset + node_box_size.width), (y_max_offset + node_box_size.height)]
        });
        this.link_layer = new Kinetic.Layer({
            x: -x_min_offset + node_box_size.width / 2
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
        this.stage.add(background_layer);
        this.stage.add(this.node_layer);
        this.stage.add(this.link_layer);
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
            id: d.data.id
        });
        var node = new Kinetic.Rect({
            x: 0,
            y: 0,
            width: node_box_size.width,
            height: node_box_size.height,
            fill: '#429842',
            draggable: true
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
            image:this.queue.getResult(man_role_map[d.depth])
            });
        var avatar02 = new Kinetic.Image({
            x:(node_box_size.width/2)+5,
            y:5,
            width:30,
            height:30,
            image:queue.getResult(woman_role_map[d.depth])
            });
        var text = new Kinetic.Text({
            fontSize:20,
            fill: 'red',
            text: d.data.id
        });
        node_group.add(node);
        node_group.add(avatar01);
        node_group.add(avatar02);
        node_group.add(text);
        this.node_layer.add(node_group);
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
        this.link_layer.add(link);
        return link;
    };
    /**
     * 家普渲染
     */
    this.render = function () {
        var tree_layout_data = this.tree_layout(d3.hierarchy(this.data));
        this.node_data = tree_layout_data.descendants()
        this.link_data = tree_layout_data.links();
        var x_offset = d3.extent(this.node_data, function (d) {
            return d.x;
        });
        var y_max_offset = d3.max(this.node_data, function (d) {
            return d.y;
        });
        var x_min_offset = x_offset[0];
        var x_max_offset = x_offset[1];
        this.stage.width(x_max_offset - x_min_offset + node_box_size.width).height(y_max_offset + node_box_size.height);
        $('#stage').width(x_max_offset - x_min_offset + node_box_size.width).height(y_max_offset + node_box_size.height);
        this.node_layer.x(-x_min_offset);
        this.link_layer.x(-x_min_offset + node_box_size.width / 2);
        var _this = this;

        var nodes = this.dom_container.selectAll('span.node')
            .data(this.node_data)
            .property('kinetic.node', function (d) {
                var node = d3.select(this).property('kinetic.node').x(d.x).y(d.y);
                node.attrs.id = d.data.id;
                for(var i in node.children){
                    if(node.children[i].className == 'Text'){
                        node.children[i].text(d.data.id);
                    }
                }
                return node;
            })
            .attr('class', 'node');
        nodes.enter()
            .append('span')
            .attr('class', 'node')
            .property('kinetic.node', function (d) {
                return _this._get_new_node(d);
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
                console.log(d,_this.link_scale(d.source.depth));
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
        this.node_layer.draw();
        this.link_layer.draw();
    };
    this.add_member = function (parent_id, member) {
        if(!parent_id || member['id'] == undefined){
            return false;
        }
        this._data_add(parent_id, member);
        this.render();
    };
    this.remove_member = function (id) {
        if(!id){
            return false;
        }
        this._data_remove(id, this.data);
        this.render();
    };
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
        this.render();
    };
    this._init();
};



