//		修改数据
function updateuserinfo(){
	//获取页面上的信息
	var mycord = $('#myCord').val();
	var mytel = $('#myTel').val();
	var sesx = $('#seex').val();
//			var xh = $('#username').html();
	var id =sessionStorage.getItem('uid');
	//以下是进行ajax请求的
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.updateuser,//请求的地址
		data: {
			'userid':id,
			'gender':sesx,
			'information':mytel,
			'card':mycord,
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				//提示是否修改成功
				layer.open({
					content: '修改成功',
					time:2,
				   });
				//重新请求我的资料的数据
				getUserinfo();
				//重新显示我的信息页面
				document.getElementById('userInfo').style.display = "block";
				//将当前页面隐藏
				$('#updateUserinfo').css("display","none");
			}
			else{
				layer.open({
					content: '您没有进行修改或操作失败',
					time:2,
				   });

			}
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}
		
	});
	
}

//		获取数据个人详情页面
function getUserinfo(){
	var id = sessionStorage.getItem('uid');
	//ajax请求
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.Searchiduser,//请求的地址
		data: {
			'userid':id,//请求的参数
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			//如果错误码为0则执行以下
			if(data.errorCode == config.Errors.success){
				//一下操作将数据展示在页面上
				$('#names').html(data.allinfo.name);
				//判断是男生还是女生
				if(data.allinfo.gender==config.Datas.man){
					$('#sexs').html("男");
				}else{
					$('#sexs').html("女");
				}
				$('#dhs').html(data.allinfo.information)
				$('#xhg').html(data.allinfo.username);
				$('#cords').html(data.allinfo.card);
				$('#louh').html(data.allinfo.typeid);
				$('#fjH').html(data.allinfo.zoneid);
				$('#xy').html(data.allinfo.shopname);
				$('#czfzr').html(data.allinfo.name);
				$('#czzh').html(data.allinfo.username);
				$('#zgmz').html(data.allinfo.shopname);
				//以下是对后台返回数据的存贮，sessionStorage的存储是浏览器关闭页面后就会自动清除
				sessionStorage.setItem('idcord',data.allinfo.card);
				sessionStorage.setItem('tel',data.allinfo.information)
			}
			
		},
		error:function(){//如果网络不通将会进入这个分支，页面不会有效果
			console.log("123")
		}

	})
}
//		获取首页的用户信息
getindexuser();
function getindexuser(){
	var id =sessionStorage.getItem('uid');
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url + config.Urls.Searchiduser,//请求的地址
		data: {
			'userid': id,//请求的参数
		},
		dataType: "json",//返回的数据格式
		success: function (data) {//成功后的响应
			//如果错误码为0则执行以下
			if (data.errorCode == config.Errors.success) {
				$('#xSuserzh').html(data.allinfo.username);
				$('#xSuserxm').html(data.allinfo.name);
				$('#xSuserye').html(data.allinfo.balance);
				$('#yddj').html(data.price);
				$('#jfzj').html(data.allinfo.recharge);
				$('#yydl').html(data.allinfo.used);
				$('#cpye').html(data.allinfo.balance);
				$('#sydl').html(data.allinfo.balance/data.price);
				$('#ydxdj').html(data.price);
				$('#jfxzj').html(data.allinfo.recharge);
				$('#yyxdl').html(data.allinfo.used);
				$('#cpxye').html(data.allinfo.balance);
				$('#syxdl').html(data.allinfo.balance/data.price);

			}
		},
		error: function () {
		}
	})
}

//充值缴费
function Userrecharge(){
	var id = sessionStorage.getItem('uid');
	var czj = $('#czje').val();
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.Userrecharge,//请求的地址
		data: {
			'userid':id,
			'money':czj
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				layer.open({
					content: '充值成功',
					time:2,
				  });
				$('#czje').val("");
				getindexuser();
				searchShockP(1);
				$('#rechord').css('display','none');
				$('#index').css('display','block')
			}
			else{
				layer.open({
					content: '充值缴费失败',
					time:2,
				 });
			}
		},
		error:function(){
			console.log("123")
		}
	});
}
searchShockP(1);
//查询缴费记录
function searchShockP(pages){
	var pages = pages;
	var id = sessionStorage.getItem('uid');
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.searchrecharge,//请求的地址
		data: {
			'userid':id,
			'page':pages,
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
			}
			else{
				 layer.open({
				content: '记录获取失败',
				time:2,
			  });
			}
		},
		error:function(){
			console.log("123")
		}
	});
}

function CreatNode(len,result){
//			$("tbody").html("")
 	Lhtml ="";
	if(result.length>0){
		for (var i=0;i<result.length;i++) {
			if(i%2 ==0){
				Lhtml +="<tr class='active'><td>"+(i+1)+"</td><td>"+result[i].name+"</td><td>"+result[i].money
						+"</td><td>"+result[i].source+"</td><td>"+result[i].source+"</td><td>清缴电费</td><td>"+result[i].time+"</td></tr>";
			}
			else{
				Lhtml +="<tr class='warning'><td>"+(i+1)+"</td><td>"+result[i].name+"</td><td>"+result[i].money
						+"</td><td>"+result[i].source+"</td><td>"+result[i].source+"</td><td>清缴电费</td><td>"+result[i].time+"</td></tr>";
			}
			
		}
	}else{
		Lhtml +="<tr><td colspan='6'><div class='empty'>没有找到数据。</div></td></tr>";
	}
//			document.getElementById("tables03").children;
	$(".table03").children()[2].innerHTML = Lhtml;
 }

//首页公告
searchnotice(1)
function searchnotice(pages){
	var pages = pages;
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.Searchnotice,//请求的地址
		data: {
			'page':pages,
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				
				$("#times").html("发布时间："+data.allinfo[0].time);
				$('#content').html(data.allinfo[0].content);
				//记录现在是第几页
				sessionStorage.setItem("page",data.pageinfo.page);
				sessionStorage.setItem('allpage',data.pageinfo.lastpage)
				
			}
			else{
				layer.open({
					content: '公告获取失败',
					time:2,
				  });
				
			}
		},
		error:function(){
			console.log("123")
		}
	});
	
}
//x修改密码
function changepassword(){
	var id = sessionStorage.getItem('uid');
	var ymm = $('#ymm').val();
	var xmm = $('#xmm').val();
	var qrmm = $('#qrmm').val();
	if(xmm !==qrmm){
		alert("两次密码不一样");
		return;
	}
	$.ajax({
		type: "POST",//post方式请求数据
		url: config.Url+config.Urls.updateuserpassword,//请求的地址
		data: {
			'userid':id,
			'password':ymm,
			'newpassword':xmm,
		},
		dataType: "json",//返回的数据格式
		success: function(data){//成功后的响应
			if(data.errorCode == config.Errors.success){
				 layer.open({
					content: '您的密码已经修改，请重新登录！',  
				        btn: ['确认'],  
				         yes: function(index, layero) {  
					        window.location.href = '../index.html'; 
					        },
				   });
			}
			else{
				layer.open({
				content: '修改密码失败',
			  });
			}
		},
		error:function(){
			console.log("123")
		}
	});
}
//提交反馈
function tjfk(){
	var id = sessionStorage.getItem('uid');
	var content = $('#addnotice').val();
	if(content !==""){
		$.ajax({
			type: "POST",//post方式请求数据
			url: config.Url+config.Urls.Addfeedback,//请求的地址
			data: {
				'userid':id,
				'content':content,
			},
			dataType: "json",//返回的数据格式
			success: function(data){//成功后的响应
				if(data.errorCode == config.Errors.success){
					 layer.open({
						content: '反馈已经提交',
						time:2,
					   });
					   $('#addnotice').val("")
				}
				else{
					layer.open({
						content: '反馈已经失败',
						time:2,
					   });
				}
			},
			error:function(){
				console.log("123")
			}
		});
	}else{
		layer.open({
			content: '请填写完整',
			time:2,
		   });
	}
	
}
		