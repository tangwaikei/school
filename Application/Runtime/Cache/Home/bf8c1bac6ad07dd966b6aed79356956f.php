<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>增加报账</title>
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

			
        <div id="content" class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><strong>报  账  列  表</strong></h4>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" action="<?php echo U('Home/Admin/addNews');?>" method='post' enctype="multipart/form-data" >

                        <div class="form-group">
                            <label for="roomname" class="col-sm-2 control-label">标题:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="title" id="title" placeholder="请填写公告的标题"/>     
                            </div>                          
                        </div>                          

                        <div class="form-group">
                            <label for="roomname" class="col-sm-2 control-label">附件:</label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control" name="attachment" id="attachment"/>     
                            </div>                          
                        </div>  

                        <div class="form-group">
                            <label for="roomname" class="col-sm-2 control-label">内容:</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" name="content" id="content" placeholder="请填写公告的内容" rows='8'/></textarea>      
                            </div>                          
                        </div>  
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-success btn-add">添加</button>                               
                            </div>                          
                        </div>
                    </form>
                </div>
            </div>
        </div>

		</div>
	</div>


</body>
</html>