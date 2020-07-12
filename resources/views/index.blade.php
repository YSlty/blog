<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		@include('UEditor::head');
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                /* height: 100vh; */
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
			.leave-msg{
				padding-bottom: 30px;
				padding-top: 30px;
				display: flex;
				justify-content: center;
			}
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height"><button class="content" onclick="updatamsg()">上传</button></div>
		<div>
			<input type="text" id="art_title" placeholder="标题">
			<select name="" id="art_type">
				<option value="0">关于我</option>
				<option value="1">学习历程</option>
				<option value="2">心情分享</option>
			</select>
			<select name="" id="son_type">
				<option value="0">html</option>
				<option value="1">css</option>
				<option value="2">js</option>
				<option value="3">jquery</option>
				<option value="4">vue</option>
				<option value="5">react</option>
				<option value="6">小程序</option>
			</select>
			<input type="text" id="art_jianjie" placeholder="简介">
		</div>
		<script id="container" name="content" type="text/plain" style="width: 95%;height: 600px;margin: 0 auto;"></script>
		<script type="text/javascript">var ue = UE.getEditor('container');</script>
		<div class="leave-msg">
			<textarea name="" id="" cols="30" rows="10"></textarea>
			<button onclick="leavemsg()">留言</button>
		</div>
		<ul style="padding: 30px 0;margin: 0 auto;width: 1200px;">
			<!-- <li style="display: flex;justify-content: space-between;align-items: center;">
				<p style="width: 1000px;">312312</p>
				<div>
					<button onclick="passLeavemsg()">通过</button>
					<button onclick="delLeavemsg()">删除</button>
				</div>
			</li> -->
		</ul>
		<script src="/js/jquery.js"></script>
		<script>
			$.ajax({
				type: "get",
				url: "api/article",
				dataType:"json",
				success: function(data){
					console.log(data)
				}
			});
			$.ajax({
				type: "get",
				url: "api/screenLeaveMsg",
				dataType:"json",
				success: function(data){
					console.log(data)
					let msg=data.data;
					for(let i=0;i<msg.length;i++){
						let list='<li id="'+msg[i].id+'" style="display: flex;justify-content: space-between;align-items: center;">';
						list+='<p style="width: 1000px;">'+msg[i].cont+'</p>';
						list+='<div>';
						list+='<button onclick="passLeavemsg(this)">通过</button>';
						list+='<button onclick="delLeavemsg(this)">删除</button>';
						list+='</div>';
						list+='</li>';
						$("ul").append(list);
					}
				}
			});
			$.ajax({
				type: "get",
				url: "api/showLeaveMsg",
				dataType:"json",
				success: function(data){
					console.log(data)
				}
			});
			function updatamsg(){
				$.ajax({
					type: "post",
					url: "api/artUpdata",
					data:{
						title:$("#art_title").val(),
						type:$("#art_type").find("option:selected").text(),
						typeId:$("#art_type").find("option:selected").val(),
						content:ue.getContent(),
						jianjie:$("#art_jianjie").val()
					},
					dataType:"json",
					success: function(data){
						console.log(data)
						alert("上传成功")
					}
				});
			}
			function leavemsg(){
				$.ajax({
					type: "post",
					url: "api/leaveMsg",
					data:{
						cont:$("textarea").val(),
// 						type:$("#art_type").find("option:selected").text(),
// 						typeId:$("#art_type").find("option:selected").val(),
						artId:"1"
					},
					dataType:"json",
					success: function(data){
						console.log(data)
					}
				});
			}
			function passLeavemsg(obj){
				$.ajax({
					type: "post",
					url: "api/passLeaveMsg",
					data:{
						id:$(obj).parents("li").attr("id")
					},
					dataType:"json",
					success: function(data){
						console.log(data)
					}
				});
			}
			function delLeavemsg(obj){
				$.ajax({
					type: "post",
					url: "api/delLeaveMsg",
					data:{
						id:$(obj).parents("li").attr("id")
					},
					dataType:"json",
					success: function(data){
						console.log(data)
					}
				});
			}
		</script>
    </body>
</html>
