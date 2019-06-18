
//创建表格函数
function createLine(Len,Len01,ls){
	Lhtml = "";
	for(var i =0;i<Len;i++){
		if(i%2 ==0){
			Lhtml +="<tr class='active'>";
			for (var j =0;j<Len01;j++) {
				Lhtml+="<td>吃饭</td>"
			}
			Lhtml+="</tr>"
		}else
		{
			Lhtml +="<tr class='warning'>";
			for (var j =0;j<Len01;j++) {
				Lhtml+="<td>吃饭</td>"
			}
			Lhtml+="</tr>"
		}
	}
	ls.html(Lhtml);
}

function createLine1(Len,Len01){
	Lhtml = "";
	for(var i =0;i<Len;i++){
		if(i%2 ==0){
			Lhtml +="<tr class='active'>";
			for (var j =0;j<Len01;j++) {
				if(j==Len01-1){
					Lhtml+="<td><input type='button' value='充值'></td>"
				}else {
					Lhtml+="<td>吃饭</td>"
				}
			}
			Lhtml+="</tr>"
		}else
		{
			Lhtml +="<tr class='warning'>";
			for (var j =0;j<Len01;j++) {
				if(j==Len01-1){
					Lhtml+="<td><input type='button' value='充值'></td>"
				}else {
					Lhtml+="<td>吃饭</td>"
				}
			}
			Lhtml+="</tr>"
		}
	}
	$("tbody").html(Lhtml);
}

function createLine2(Len,Len01,data){
	Lhtml = "";
	for(var i =0;i<Len;i++){
		if(i%2 ==0){
			Lhtml +="<tr class='active'><td>"+(i+1)+"</td><td>"+data.college+"</td><td>"+data.class
			+"</td><td>"+data.floor+"</td><td>"+data.drom+"</td><td>"+data+"</td><td><input type='button' value='充值'></td></tr>";

		}else
		{
			Lhtml +="<tr class='warning'><td>"+(i+1)+"</td><td>"+data.college+"</td><td>"+data.class
			+"</td><td>"+data.floor+"</td><td>"+data.drom+"</td><td>"+data+"</td><td><input type='button' value='充值'></td></tr>";

		}
	}
	$("tbody").html(Lhtml);
}

//		导入文件函数
function drwj(dow,data){
	data =data?data:"";
	dow.ajaxSubmit({
		dataType:  'json',
		data:data,
		success: function(data) {
			if(data.errorCode == config.Errors.success){
				layer.open({
					content: '导入成功',
					time:1
				});
			}else{
				layer.open({
					content: '导入失败',
					time:1
				});
			}
		},
		error:function(xhr){
			layer.open({
				content: '网络异常',
				time:1
			});
		}
	});
}