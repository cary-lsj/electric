//拉取业种
		
function lqlh(){
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.shoptypeinfo,//请求的地址
		data: {
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
//						console.log("123")
				Thtml = "<option value=''>— — —</option>";
				for (var i=0;i<data.allinfo.length;i++) {
					Thtml += "<option  value='"+data.allinfo[i].id+"'>"+data.allinfo[i].name+"</option>"
				}
				$('.lqlh').html(Thtml);
			}
			else{
				layer.open({
				content: '拉取业种失败',  
		    });
			}
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}
	})
}
	
	

		
//通过业种id拉取分区

function lqbj(id){
	var ids;
	if(id ==""){
		ids = $('.lqlh').val()
	}
	else{
		ids = id;
	}
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.shopzoneinfo,//请求的地址
		data: {
			'id':ids,
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
//						console.log("123")
				Thtml = "<option value=''>— — —</option>";
				for (var i=0;i<data.allinfo.length;i++) {
					Thtml += "<option value='"+data.allinfo[i].id+"'>"+data.allinfo[i].name+"</option>"
				}
				$('.lqbj').html(Thtml);
			}
			else{
				layer.open({
					content: '分区拉取失败',  
		    	});
			}
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}
	})
}
		


//添加业种
function addxy(){
	var xy = $('#addxy').val();
	if(xy !==""){
		$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.Addtype,//请求的地址
		data: {
			"name":xy
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				layer.open({
					content: '录入数据成功',  
			    });
				$('#addxy').val("")
				lqlh();
			}
			else{
				layer.open({
					content: '录入业种失败',  
			    });
			}
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}
	})
	}else{
		layer.open({
			content: '请填写完整',  
	    });
	}	
}

//添加分区
function addbj(){
	var lqxy = $('#addfqY').val();
	var xy = $('#addfqQ').val();
	if(lqxy !=="" && xy!==""){
		$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.Addzone ,//请求的地址
		data: {
			"name":xy,
			"typeid":lqxy
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				layer.open({
					content: '录入数据成功',  
			    });
				$('#addfqQ').val("")
			}
			else{
				layer.open({
					content: '录入分区失败',  
			    });
			}
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}
	})
	}
	else{
		layer.open({
			content: '请填写完整',  
	    });
	}
	
}

		//添加用户
		function addStudent(){
			var adduserxh = $('#addUserxh').val();
			var adduserxm = $('#addUserxm').val();
			var addUserbj = $('#addUserfq').val();
			var addUseryx = $('#addUseryz').val();
//			var addUserlh = $("#userlh").val();
//			var addUserss = $("#userss").val();
			var addUserid = $('#addUserid').val();
			var addUsermm = "123456";
			var addUsersex=$('#seex').val()
			var addUserTel  =$('#addUserTel').val();
			var shopname = $('#addUserzg').val()
			if(adduserxh !=="" && adduserxm !==""&& addUserid !==""&& addUsermm !=="" &&shopname!==""&&addUseryx!==""&&addUserbj!==""){
					$.ajax({
					type: "POST",//post方式请求数据
					url: config.Url+config.Urls.Adduser,//请求的地址
					data: {
						"username":adduserxh,
						"password":addUsermm,
						'name':adduserxm,
						"shopname":shopname,
						"gender":addUsersex,
						"information":addUserTel,
						"typeid":addUseryx,
						"zoneid":addUserbj,
						'card':addUserid
					},
					dataType: "json",//返回的数据格式
					success: function(data){//成功后的响应
						if(data.errorCode == config.Errors.success){
							layer.open({
								content: '添加成功,用户密码为：123456',  
						    });
							
							$('#addUserxh').val("");
							$('#addUserxm').val("");
							$('#addUserfq').val("");
							$('#addUserTel').val("");
							$('#addUserid').val("")
						}
						else{
							layer.open({
								content: '用户添加失败',  
						    });
						}
					},
					error:function(){//如果网络不通将会进入这个分支，页面不会有效果
						console.log("123")
					}
				})
			}else{
				layer.open({
					content: '请填写完整',  
			    });
			}
		}
		//获取电的原价格
		
		function getDyjg(){
			$.ajax({
				type: "POST",//post方式请求数据
				url: config.Url+config.Urls.Priceinfo,//请求的地址
				data: {
				},
				dataType: "json",//返回的数据格式
				success: function(data){//成功后的响应
					if(data.errorCode == config.Errors.success){
						$('#Yprice').html(data.price+"元/度");
					}
					else{
						layer.open({
							content: '数据获取失败',  
					    });
					}
				},
				error:function(){//如果网络不通将会进入这个分支，页面不会有效果
					console.log("123")
				}
			})
		}
		
		//更改用电价格
		function updateYdjg(){
			var price = $('#newprice').val();
			$.ajax({
				type: "POST",//post方式请求数据
				url: config.Url+config.Urls.Updateprice,//请求的地址
				data: {
					'price':price
				},
				dataType: "json",//返回的数据格式
				success: function(data){//成功后的响应
					if(data.errorCode == config.Errors.success){
						layer.open({
								content: '修改价格成功',  
						    });
						
						$('#newprice').val("");
						getDyjg();
					}
					else{
						layer.open({
								content: '修改价格失败',  
						    });
						
					}
				},
				error:function(){//如果网络不通将会进入这个分支，页面不会有效果
					console.log("123")
				}
			})
		}
		//发布公告信息
		function addNotice(){
			var content = $('#addnotice').val();
			$.ajax({
				type: "POST",//post方式请求数据
				url: config.Url+config.Urls.Addnotice,//请求的地址
				data: {
					'content':content
				},
				dataType: "json",//返回的数据格式
				success: function(data){//成功后的响应
					if(data.errorCode == config.Errors.success){
						layer.open({
								content: '公告发布成功',  
						    });
					
						$('#addnotice').val("");
//						getDyjg();
					}
					else{
						layer.open({
								content: '公告发布失败',  
						   });
					}
				},
				error:function(){//如果网络不通将会进入这个分支，页面不会有效果
					console.log("123")
				}
			})
		}
