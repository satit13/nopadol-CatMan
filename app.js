$(function() {

    $(".search-input").keyup(function() {

        var searchString = $(this).val();
        console.log(searchString);
        $('#jstree').jstree('search', searchString);
    });


    $('#jstree').jstree({
    "animation" : 0,
    "check_callback" : true,
    "themes" : { "stripes" : true },
    'data' : {
      'url' : function (node) {
        return node.id === '#jstree' ?
          'ajax_demo_roots.json' : 'ajax_demo_children.json';
      },
      'data' : function (node) {
        return { 'id' : node.id };
      }
    },
    "types" : {
    "#jstree" : {
      "max_children" : 1,
      "max_depth" : 4,
      "valid_children" : ["root"]
    },
    "default" : {
      "valid_children" : ["default","file"]
    },
    "file" : {
      "icon" : "glyphicon glyphicon-file",
      "valid_children" : []
    }
    },
        'core': {

            'data': [{
                "id": "1.0",
                "text": "Family1",
                "icon": "",
                "state": {
                    "opened": false,
                    "disabled": false,
                    "selected": false
                },
                "children": [{
                    "id": "1.1",
                    "text": "Department1",
                    "icon": "",
                    "state": {
                        "opened": false,
                        "disabled": false,
                        "selected": false
		                    },
		                    "children": [{
		                    "id": "1.2.1",
		                    "text": "category1",
		                    "icon": "",
		                    "state": {
		                        "opened": false,
		                        "disabled": false,
		                        "selected": false
		                    },                            
                                    "children": [{
                                    "id": "1.2.1.1",
                                    "text": "subcate1",
                                    "icon": "",
                                    "state": {
                                        "opened": false,
                                        "disabled": false,
                                        "selected": false
                                    },
                                                "children": [{
                                                "id": "1.2.1.1.1",
                                                "text": "items1",
                                                "icon": "",
                                                "state": {
                                                    "opened": false,
                                                    "disabled": false,
                                                    "selected": false
                                                },
                                                "children": false,
                                                "liAttributes": null,
                                                "aAttributes": null
                                            }, {
                                                "id": "1.2.1.1.2",
                                                "text": "items2",
                                                "icon": "",
                                                "state": {
                                                    "opened": false,
                                                    "disabled": false,
                                                    "selected": false
                                                },
                                                "children": false,
                                                "liAttributes": null,
                                                "aAttributes": null
                                            }, {
                                                "id": "1.2.1.1.3",
                                                "text": "items3",
                                                "icon": "",
                                                "state": {
                                                    "opened": false,
                                                    "disabled": false,
                                                    "selected": false
                                                },
                                                "children": false,
                                                "liAttributes": null,
                                                "aAttributes": null
                                            }],
                                    "liAttributes": null,
                                    "aAttributes": null
                                }, {
                                    "id": "1.2.1.2",
                                    "text": "subcate2",
                                    "icon": "",
                                    "state": {
                                        "opened": false,
                                        "disabled": false,
                                        "selected": false
                                    },
                                    "children": false,
                                    "liAttributes": null,
                                    "aAttributes": null
                                }, {
                                    "id": "1.2.1.3",
                                    "text": "subcate3",
                                    "icon": "",
                                    "state": {
                                        "opened": false,
                                        "disabled": false,
                                        "selected": false
                                    },
                                    "children": false,
                                    "liAttributes": null,
                                    "aAttributes": null
                                }],
		                    "liAttributes": null,
		                    "aAttributes": null
		                }, {
		                    "id": "1.2.2",
		                    "text": "category2",
		                    "icon": "",
		                    "state": {
		                        "opened": false,
		                        "disabled": false,
		                        "selected": false
		                    },
		                    "children": false,
		                    "liAttributes": null,
		                    "aAttributes": null
		                }, {
		                    "id": "1.2.3",
		                    "text": "category3",
		                    "icon": "",
		                    "state": {
		                        "opened": false,
		                        "disabled": false,
		                        "selected": false
		                    },
		                    "children": false,
		                    "liAttributes": null,
		                    "aAttributes": null
		                }],		                
                    "liAttributes": null,
                    "aAttributes": null
                }, 
                {
                    "id": "1.2",
                    "text": "Department2",
                    "icon": "",
                    "state": {
                        "opened": false,
                        "disabled": false,
                        "selected": false
                    },
                    "children": false,
                    "liAttributes": null,
                    "aAttributes": null
                }, {
                    "id": "1.3",
                    "text": "Department3",
                    "icon": "",
                    "state": {
                        "opened": false,
                        "disabled": false,
                        "selected": false
                    },
                    "children": false,
                    "liAttributes": null,
                    "aAttributes": null
                }, {
                    "id": "1.4",
                    "text": "Department4",
                    "icon": "",
                    "state": {
                        "opened": false,
                        "disabled": false,
                        "selected": false
                    },
                    "children": false,
                    "liAttributes": null,
                    "aAttributes": null
                }, {
                    "id": "1.5",
                    "text": "Department5",
                    "icon": "",
                    "state": {
                        "opened": false,
                        "disabled": false,
                        "selected": false
                    },
                    "children": false,
                    "liAttributes": null,
                    "aAttributes": null
                }],
                "liAttributes": null,
                "aAttributes": null
            }, {
                "id": "2.0",
                "text": "Family2",
                "icon": "",
                "state": {
                    "opened": false,
                    "disabled": false,
                    "selected": false
                },
                "children": [],
                "liAttributes": null,
                "aAttributes": null
            }, {
                "id": "3.0",
                "text": "Family3 ",
                "icon": "",
                "state": {
                    "opened": false,
                    "disabled": false,
                    "selected": false
                },
                "children": [],
                "liAttributes": null,
                "aAttributes": null
            }, {
                "id": "4.0",
                "text": "Family4",
                "icon": "",
                "state": {
                    "opened": false,
                    "disabled": false,
                    "selected": false
                },
                "children": [],
                "liAttributes": null,
                "aAttributes": null
            }]



        },
        "search": {

            "case_insensitive": true,
            "show_only_matches" : true


        },

        "plugins": ["search"]


    });
});
