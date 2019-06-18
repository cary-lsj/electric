//学生信息的查询和拉取
function searchShockP(pages){
	var Sxh = $('#Sxh').val();
	var Syx = $('#Syx').val();
	var Sbj = $('#Sbj').val();
	var pages = pages;
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.Searchuser,//请求的地址
		data: {
			"username":Sxh,
			"typeid":Syx,
			"zoneid":Sbj,
			'page':pages
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				var Sdata =data.allinfo;
						var options={
							"id":"page",//显示页码的元素
							"data":Sdata,//显示数据
							"maxshowpageitem":3,//最多显示的页码个数
							"pagelistcount":data.pageinfo.listrows,//每页显示数据个数
							"callBack":function(result){
								var rlength =result.length;
								CreatNode(rlength,result);
							}
						};
						//传过去数据地总条数，当前页码，和配置好的信息
						page.init(data.pageinfo.total,data.pageinfo.page,options);
						
				$('#Sbj').val("");
				$('#Sxh').val("");
				$('#Syx').val("");
			}
			else{
				layer.open({
					content: '数据获取失败，请确认是否刷新页面',  
				        btn: ['确认','取消'],  
				         yes: function(index, layero) {
							 window.location.reload();
					    },
					    btn2: function(index, layero) {  
  							layer.msg('您取消了操作')
                        }  
				   });
			}
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}
	})
}

//创建节点
 function CreatNode(len,result){
 	Lhtml ="";
	if(result.length>0){
		for (var i=0;i<result.length;i++) {
			if(i%2 ==0){
				Lhtml +="<tr class='active'><td>"+(i+1)+"</td><td>"+result[i].typeid+"</td><td>"+result[i].zoneid
						+"</td><td>"+result[i].shopname+"</td><td>"+result[i].name+"</td><td>"+result[i].information+"</td><td>"+result[i].used+"度</td><td>"+result[i].balance+
						"</td><td><input class='btn btn-danger' type='button' onclick='xscz("+result[i].id+","+result[i].username+")' value='充值'>"+
						"</td><td><input class='btn btn-warning' type='button' onclick='lryd("+result[i].id+")' value='录入用电'></td>"+
						"<td><input class='btn btn-info' onclick='deluser("+result[i].id+")' type='button' value='删除'></td></tr>";
			}
			else{
				Lhtml +="<tr class='warning'><td>"+(i+1)+"</td><td>"+result[i].typeid+"</td><td>"+result[i].zoneid
						+"</td><td>"+result[i].shopname+"</td><td>"+result[i].name+"</td><td>"+result[i].information+"</td><td>"+result[i].used+"度</td><td>"+result[i].balance+
						"</td><td><input class='btn btn-danger' type='button' onclick='xscz("+result[i].id+","+result[i].username+")' value='充值'>"+
						"</td><td><input class='btn btn-warning' type='button' onclick='lryd("+result[i].id+")' value='录入用电'></td>"+
						"<td><input class='btn btn-info' onclick='deluser("+result[i].id+")' type='button' value='删除'></td></tr>";
			}
			
		}
	}else{

	}
	$("#tables01").html(Lhtml);
 }

//在用户信息下的充值按钮显示充值页面
function xscz(lh,ss){
	$('.infos').css('display','none');
	$('#rechord').css('display','block');
	//$("#rechordId").html(ss);
	//$('#rechordId').val(lh);
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.searchiduser,//请求的地址
		data: {
			'userid':lh,
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				$('#rechordname').html(data.allinfo.name);
				$('#rechordname').val(data.allinfo.id);
				$('#rechordzg').html(data.allinfo.shopname);
				//$('#Sxfzr').val(id);
			}
			else{
				layer.open({
					content: '操作失败',  
				        btn: ['确认','取消'],  
				         yes: function(index, layero) {  
					        layer.msg('您已经确认了操作');
					    },
					    btn2: function(index, layero) {  
  							layer.msg('您取消了操作');
                        }  
				   });
			}
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}
	})


	
}
//绑定充值按钮的单击事件
	$('#btncz').on('click',function(){
		var userid = $('#rechordname').val();
		var money = $('#czje').val();
		$.ajax({
			type: "POST",//post方式请求数据
			url: config.Url+config.Urls.Addrecharge,//请求的地址
			data: {
				'userid':userid,
				'money':money,
			},
			dataType: "json",//返回的数据格式
			success: function(data){//成功后的响应
				if(data.errorCode == config.Errors.success){
					layer.open({
						content: "成功为"+data.username+"充值"+money+"元，共计余额"+data.balance+"元",
						time:2,
					});
					//alert("成功为"+data.username+"充值"+money+"元，共计余额"+data.balance+"元");
					//隐藏当前页面显示
					searchShockP(1);
					$('#rechordname').html("");
					$('#rechordzg').html("");
					$("#rechordId").html("");
					$('#rechord').css('display','none');
					$('#userInfo').css('display','block');
				}
				else{
					layer.open({
					content: '操作失败',  
				        btn: ['确认','取消'],  
				         yes: function(index, layero) {  
					        layer.msg('您已经确认了操作');
					    },
					    btn2: function(index, layero) {  
  							layer.msg('您取消了操作');
                        }  
				   });
				}
			},
			error:function(){//如果网络不通将会进入这个分支，页面不会有效果
				console.log("123")
			}
		});
		$('#czje').val("");
	});
	
	//首页显示录入用电并通过id获取该用户的信息显示在哪页面上
	function lryd(id){
		$('.infos').css('display','none');
		$('#addyongd').css('display','block');
//		$('#Sxfzr').val(id);
		$.ajax({
			type: "POST",//post方式请求数据
			url: config.Url+config.Urls.searchiduser,//请求的地址
			data: {
				'userid':id
				
			},
			dataType: "json",//返回的数据格式
			success: function(data){//成功后的响应
				if(data.errorCode == config.Errors.success){
					//在页面上显示用户的信息
					$('#Sxfzr').html(data.allinfo.name);
					$('#Sxzg').html(data.allinfo.shopname);
					//保存用户的id
					$('#Sxfzr').val(id);
				}
				else{
					layer.open({
					content: '数据录入失败请重新操作',  
				        btn: ['确认','取消'],  
				         yes: function(index, layero) {  
					        layer.msg('您已经确认了操作');
					    },
					    btn2: function(index, layero) {  
  							layer.msg('您取消了操作');
                        }  
				   });
				}
			},
			error:function(){//如果网络不通将会进入这个分支，页面不会有效果
				console.log("123")
			}
		})
		
	}
	//删除用户。
	function deluser(id){
		$.ajax({
			type: "POST",//post方式请求数据
			url: config.Url+config.Urls.Deluser,//请求的地址
			data: {
				'userid':id,	
			},
			dataType: "json",//返回的数据格式
			success: function(data){//成功后的响应
				if(data.errorCode == config.Errors.success){
					layer.open({
						content: '删除成功',
						time:2
				    });
					searchShockP(1);
				}
				else{
					layer.open({
						content: '删除成功',
						time:2
				    });
				}
			},
			error:function(){//如果网络不通将会进入这个分支，页面不会有效果
				console.log("123")
			}
		})
	}
	
	//绑定录入用电按钮的单击事件
	$('#btnxjyd').on('click',function(){
		var userid = $('#Sxfzr').val();
		var used = $('#used').val();
		$.ajax({
			type: "POST",//post方式请求数据
			url: config.Url+config.Urls.Addused,//请求的地址
			data: {
				'userid':userid,
				'used':used
			},
			dataType: "json",//返回的数据格式
			success: function(data){//成功后的响应
				if(data.errorCode == config.Errors.success){
					layer.open({
						content: '录入数据成功',
						time:2

				    });
					$('#Sxfzr').html("");
					$('#Sxzg').html("");
					$('#Sxfzr').val("");
					//隐藏当前页面显示
					searchShockP(1);
					$('#addyongd').css('display','none');
					$('#userInfo').css('display','block');
				}
				else{
					layer.open({
						content: '录入数据失败'
				    });
				}
			},
			error:function(){//如果网络不通将会进入这个分支，页面不会有效果
				console.log("123")
			}
		})
		$('#used').val("");
	})
