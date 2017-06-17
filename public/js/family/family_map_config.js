/**
 * Created by Administrator on 2017/6/4.
 */
var stage_size = {width:500,height:600};
//节点框尺寸
var node_box_size = {width: 80, height: 40};
//节点尺寸， (节点框+节点连线)
var node_size = [100,100];

//测试数据
var data = {
    "id" : 1,
    "name": "flare",
    children:[
        {
            id:2,
            name:'a',
            children:[
                {
                    id:2,
                    name:'a'
                },
                {
                    id:2,
                    name:'a',
                    children:[
                        {
                            id:2,
                            name:'a',
                            children:[
                                {
                                    id:2,
                                    name:'a'
                                },
                                {
                                    id:2,
                                    name:'a',
                                    children:[
                                        {
                                            id:2,
                                            name:'a'
                                        },
                                        {
                                            id:2,
                                            name:'a',
                                            children:[
                                                {
                                                    id:2,
                                                    name:'a'
                                                },
                                                {
                                                    id:2,
                                                    name:'a',
                                                    children:[
                                                        {
                                                            id:2,
                                                            name:'a'
                                                        },
                                                        {
                                                            id:2,
                                                            name:'a'
                                                        }
                                                    ]
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            id:2,
                            name:'a'
                        }
                    ]
                }
            ]
        },
        {
            id:2,
            name:'a'
        }
    ]
};