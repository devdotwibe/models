<?php 
session_start(); 
include('includes/config.php');
include('includes/helper.php');
//printR($_SESSION);
if($_SESSION["log_user"]){
	$id = $_GET['id'];
	if($id){
		$ticket_view = DB::queryFirstRow("SELECT * FROM tickets WHERE user_id = %s  and id = %s ", $_SESSION['log_user_id'],$id);
		if($_POST){
			$post_data = array_from_post(array('description'));
			$post_data['user_id'] = $_SESSION['log_user_id'];
			$post_data['ticket_id'] = $id;
			$post_data['created_date'] = date('Y-m-d H:i:s');
			DB::insert('tickets_comment', $post_data);
			header("Location: viewsupport.php?id=".$id);
		}
		//echo DB::lastQuery();die;
		if(!$ticket_view){
			header("Location: supports.php");
		}

		$problems_comment = DB::query("SELECT * FROM tickets_comment WHERE ticket_id = %s ",$id);
		
	}
	else{
		header("Location: supports.php");
	}
}
else{
	header("Location: login.php");
}
	
$userName = $_SESSOION['log_user'];
?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<title><?=$ticket_view['name']?> | The Live Model</title>
<?php  include('includes/head.php'); ?>

<style>
.control-label{
	padding:0px !important;
}

.timelines {
    list-style-type: none;
    margin: 0;
    margin-top: 20px;
    padding: 0;
    position: relative;
}
.timelines:before {
    content: '';
    position: absolute;
    top: 5px;
    bottom: 5px;
    width: 5px;
    background: #2d353c;
    left: 5%;
    margin-left: -2.5px;
}
.timelines > li {
    position: relative;
    min-height: 50px;
}
.timelines > li + li {
    margin-top: 10px;
}
.timelines .timelines-time {
    position: absolute;
    left: 0;
    width: 15%;
    text-align: right;
    padding-top: 7px;
}
.timelines .timelines-time .date,
.timelines .timelines-time .time {
    display: block;
}
.timelines .timelines-time .date {
    line-height: 18px;
    font-size: 14px;
}
.timelines .timelines-time .time {
    line-height: 28px;
    font-size: 24px;
    color: #242a30;
}
.timelines .timelines-icon {
    left: 2.8%;
    position: absolute;
    width: 10%;
    text-align: center;
    top: 5px;
}
.timelines .timelines-icon a {
	display: flex;
    justify-content: center;
    align-items: center;
	text-decoration: none;
    width: 50px;
    height: 50px ;
    -webkit-border-radius: 50px !important;
    -moz-border-radius: 50px !important;
    border-radius: 50px !important;
    background: #575d63;
    line-height: 40px;
    color: #fff;
    font-size: 14px;
    border: 5px solid #2d353c;
    transition: background .2s linear;
    -moz-transition: background .2s linear;
    -webkit-transition: background .2s linear;
	padding:0px;
}
.timelines .timelines-icon a:hover,
.timelines .timelines-icon a:focus {
    background: #00acac;
}
.timelines .timelines-body {
    margin-left: 9%;
    margin-right: 0%;
    background: #f4f4f4;
    position: relative;
    padding: 8px 10px;
    border-radius: 4px;
    -moz-border-radius: 4px;
    -webkit-border-radius: 4px;
}
.timelines .timelines-body:before {
    content: '';
    display: block;
    position: absolute;
    border: 10px solid transparent;
    border-right-color: #f4f4f4;
    left: -20px;
    top: 20px;
}
.timelines-header {
    padding-bottom: 5px;
    border-bottom: 1px solid #e2e7eb;
    line-height: 15px;
}
.timelines-header .userimage {
    float: left;
    width: 34px;
    height: 34px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    overflow: hidden;
    margin: -2px 10px -2px 0;
}
.timelines-header .username {
    font-size: 16px;
    font-weight: 600;
}
.timelines-header .username,
.timelines-header .username a {
    color: #00acac;
}
.timelines img {
    max-width: 100%;
    display: block;
}
.timelines-content {
    font-size: 14px;
}
.timelines-header + .timelines-content,
.timelines-header + .timelines-footer,
.timelines-content + .timelines-footer {
    margin-top: 10px;
}
.timelines-content:before,
.timelines-content:after {
    content: '';
    display: table;
    clear: both;
}
.timelines-title {
    margin-top: 0;
}
.timelines-footer {
    margin: -20px -30px;
    padding: 20px 30px;
    background: #e8ecf1;
    -webkit-border-radius: 0 0 4px 4px;
    -moz-border-radius: 0 0 4px 4px;
    border-radius: 0 0 4px 4px;
}
.timelines-footer a:not(.btn) {
    color: #575d63;
}
.timelines-footer a:not(.btn):hover,
.timelines-footer a:not(.btn):focus {
    color: #2d353c;
}
.timelines .dl-horizontal{
	margin-bottom:4px;
}
/* timelines Setting */

@media (max-width: 979px) {
    .timelines .timelines-body {
        margin-left: 25%;
        margin-right: 10%;
    }
    .timelines .timelines-time {
        width: 13%;
    }
    .timelines .timelines-icon {
        left: 13%;
        width: 12%;
    }
    .timelines:before {
        left: 19%;
    }
}
@media (max-width: 767px) {
    .timelines:before {
        left: 50%;
    }
    .timelines .timelines-body {
        margin-right: 0;
        margin-left: 0;
        margin-top: 10px;
        padding: 20px;
    }
    .timelines .timelines-footer {
        margin: 20px -20px -20px;
        padding: 20px;
    }
    .timelines .timelines-body:before {
        border-bottom-color: #fff;
        border-right-color: transparent;
        left: 50%;
        top: -20px;
        margin-left: -10px;
    }
    .timelines .timelines-time {
        right: 50%;
        left: 0;
        width: auto;
        margin-right: 40px;
        padding-top: 5px;
    }
    .timelines .timelines-icon {
        left: 15px;
        width: 80px;
        position: relative;
        margin: 0 auto;
		top:-3px
    }
}

.static-info {
  margin-bottom: 10px;
}
.static-info .name {
  font-size: 14px;
  font-weight: normal;
}
.static-info .value {
  font-size: 14px;
}
</style>
<style>
.dl-horizontal dt {
  width: 80px;
}
.dl-horizontal dd {
  margin-left: 112px;
}
@media (max-width: 979px) {
	.dl-horizontal dd {
	  margin-left: 0px;
	}
}
.view-data .control-label {
  text-align: left;
  margin-left:10px;
}
/*label.radio-inline.checked, label.checkbox-inline.checked, label.radio.checked, label.checkbox.checked {
  background-color: #266c8e;
  color: #fff !important;
}*/
</style>

	</head>

<body class="page-template-default page page-id-319 custom-background">
   <?php include('includes/header.php'); ?>

      <div class="container mb-4">

        <div id="content" class="clearfix ">
<div class="row">        
<div class="col-md-8">
    <div class="card">
    <div class="card-header">
        <span class="card-title">View</span>
    </div>
    <div class="card-body">
        <!-- Credit Card -->
        <div class="portlet-body">
            <div class="row static-info">
                <div class="col-md-3 name"><strong>Title</strong></div>
                <div class="col-md-9 value"><?=$ticket_view['name'];?></div>
            </div>    
            <div class="row static-info">
                <div class="col-md-3 name"><strong>Descrition</strong></div>
                <div class="col-md-9 value"><?=$ticket_view['description'];?></div>
            </div>
            
            
        
        </div>
    
    </div>
    </div>
</div>    
    <!--//col-md-8//-->
<div class="col-md-4">
<div class="card">
<div class="card-header">
    <span class="card-title">Status Details</span>
</div>
<div class="card-body">
    <!-- Credit Card -->
    <div class="row static-info">
        <div class="col-md-4 col-xs-4 name"><strong>Date</strong></div>
        <div class="col-md-8 col-xs-8 value"><?=h_dateFormat($ticket_view['created_at'],'d-m-Y');?></div>
   </div>
    <div class="row static-info">
        <div class="col-md-4 col-xs-4  name"><strong>Status</strong></div>
        <div class="col-md-8 col-xs-8 value show-status"><?=$ticket_view['status'];?></div>
    </div>

</div>
</div>

    </div>

      
        </div>
<div class="row">
	<div class="col-md-12">
<ul class="timelines">
<?php
if($problems_comment){
	foreach($problems_comment as $set_data){
		$commentName = 'Support Team';
		if($set_data['user_id']!=0){
			$commentName = $_SESSION['log_user'];
		}
?>
<li>
    <!-- begin timelines-icon -->
    <div class="timelines-icon">
        <a href="javascript:;"><i class="fa fa-user"></i></a>
    </div>
    <!-- end timelines-icon -->
    <!-- begin timelines-body -->
    <div class="timelines-body">
        <div class="timelines-header">
            <span class="username"><a href="javascript:;"><?=$commentName?></a> <small></small></span>
            <span class="pull-right text-muted"><?=h_dateFormat($set_data['created_date'],'d M Y, h:i:A');?></span>
        </div>
        <div class="timelines-content">
            <p><?=$set_data['description'];?></p>

        </div>
    </div>
</li>
<?php             
   }
}
?>                        
<?php
if($ticket_view['status']!='Completed'){
?>				
                <li>
			        <div class="timelines-icon">
			            <a href="javascript:;"><i class="fa fa-user"></i></a>
			        </div>
			        <div class="timelines-body">
	                    <div class="timelines-header">
			                <span class="username"><a href="javascript:;">Reply</a> <small></small></span>

			            </div>
						<div class="panel-body" style="padding:5px 0 0 0">
<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="reply_set" value="set"  />
<input type="hidden" name="ticket_id" value="<?=$id?>"  />
<div class="form-body">                      
<div class="form-group row">
<label class="col-lg-2 control-label">Comment</label>
<div class="col-lg-10">
<textarea name="description" id="input-comment" rows="1" style="height:100px" class=" form-control" required></textarea>
</div>
</div>
</div>
<div class="form-actions">
<div class="row">
<div class="col-md-offset-2 col-md-9">
<button type="submit" class="btn btn-info">Submit</button>
</div>
</div>
</div>
</form>
            </div>
			        </div>
			    </li>	
<?php
}
?>
			</ul>
    </div>
    
</div>
</div>

      </div> 

 <?php include('includes/footer.php'); ?>

  </body>


</html> 
