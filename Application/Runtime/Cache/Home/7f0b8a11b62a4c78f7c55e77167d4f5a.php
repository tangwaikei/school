<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>公告列表</title>
	<link rel="stylesheet" href="/account/statics/bootstrap3/css/bootstrap.min.css" />
	<link rel="stylesheet" href="/account/statics/bootstrap3/css/bootstrap-theme.min.css" />	
	<link rel="stylesheet" href="/account/statics/css/default.css" />
	<script src="/account/statics/bootstrap3/js/jquery.min.js"></script>
	<script src="/account/statics/bootstrap3/js/bootstrap.min.js"></script>
	<script src="/account/statics/bootstrap3/js/public.js"></script>
	
	<style type="text/css">
		body{
			padding-top: 70px;
		}
	</style>
</head>

<body>
	<!--nav导航条-->
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">	
		<div class="container">
			<div class="collapse navbar-collapse">
			    <ul class="nav navbar-nav">
			      <li class="active"><a href="#">我的面板</a></li>
			      <li><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
			      <li><a href="<?php echo U('Home/User/userEdit');?>">设置</a></li>			      
			      <li><a href="#">下载</a></li>
			      <li><a href="#">登入</a></li>	
			      <li><a href="#">模块</a></li>		      
			      <li><a href="#">扩展</a></li>
			    </ul>

			    <ul class="nav navbar-nav navbar-right">
			   		<li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" role="button" href="#"><i class="glyphicon glyphicon-user"></i> <?php echo (session('username')); ?> <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo U('Home/User/userEdit');?>" tabindex="-1"><i class="glyphicon glyphicon-cog"></i>	设置</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo U('Home/Login/logout');?>" tabindex="-1"><i class="glyphicon glyphicon-off"></i>	退出</a>
                            </li>
                        </ul>
                    </li>
			    </ul>
  			</div><!-- /.navbar-collapse -->
		</div>
	</nav>
	<!--/nav导航条-->
	<div class="container">
		<div class="row">
			
	<div id="sidebar" class="col-sm-2">
		<div class="panel-group" id="accordion">
			<div class="panel panel-primary">
			    <div class="panel-heading">
			     	<h4 class="panel-title">
			       		<a data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="glyphicon glyphicon-user"></i> 管 理 事 务</a>
			      	</h4>
			    </div>
			    <div id="collapseOne" class="panel-collapse collapse in">
				      	<div class="panel-body">
				         	<ul class=" nav nav-pills nav-stacked">
					          	<li><a href="<?php echo U('Home/Admin/accountList');?>">报账列表</a></li>
					      		<li><a href="<?php echo U('Home/Admin/accountAdd');?>">添加报账</a></li>
					      		<li><a href="<?php echo U('Home/Admin/newsList');?>">新闻列表</a></li>
					      		<li><a href="<?php echo U('Home/Admin/newsAdd');?>">添加新闻</a></li>
					      		<li><a href="<?php echo U('Home/User/userList');?>">用户列表</a></li>
				      		</ul>
				     	 </div>
			    </div>
	        </div>
	    </div>    
</div>	

			
		<div id="content" class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><strong>公  告  列  表</strong></h4>
					<a href="<?php echo U('Home/Admin/newsAdd');?>"><i class="glyphicon glyphicon-plus"></i></a>
				</div>

				<div class="panel-body">
					<table class="table table-hover table-bordered table-condensed">
						<tr>
							<td width="10%">序号</td>			
							<td width="60%">标题</td>
							<td width="20%">日期</td>
							<td width="10%">浏览数</td>							
						</tr>
						
						<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($i+$num); ?></td>
								<td><a href="<?php echo U('Home/Admin/newsRead',array('id'=>$vo['id']));?>"><?php echo ($vo['title']); ?></a></td>
								<td><?php echo ($vo['time']); ?></td>
								<td><?php echo ($vo['click']); ?></td>		
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							<tr>
								<td colspan="4"><?php echo ($page); ?></td>
							</tr>
					</table>
				</div>

			</div>
		</div>

		</div>
	</div>


</body>
</html>