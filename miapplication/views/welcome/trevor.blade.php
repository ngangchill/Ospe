
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Hoosk Dash - hoosk</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="{{ base_url() }}assets/default/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ base_url() }}assets/default/css/responsive.min.css" rel="stylesheet">
<link href="{{ base_url() }}assets/default/css/font-awesome.min.css" rel="stylesheet">
<link href="http://hoosk.dev/theme/admin/css/style.css" rel="stylesheet">
<link href="http://hoosk.dev/theme/admin/css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script src="http://hoosk.dev/theme/admin/js/jquery-1.10.2.min.js"></script> 
<script src="http://hoosk.dev/theme/admin/js/jquery-ui-1.9.2.js"></script> 
<script src="http://hoosk.dev/theme/admin/js/jquery.nestable.js"></script> 

<script src="http://hoosk.dev/theme/admin/js/excanvas.min.js"></script> 
<script src="http://hoosk.dev/theme/admin/js/bootstrap.js"></script>
<script src="http://hoosk.dev/theme/admin/js/base.js"></script> 
</head>
<body>
<div class="wrapper">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">     <div class="navbar-header"><a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand"><img src="http://hoosk.dev/theme/admin/images/logo.png"></a>
      </div>
      <div class="nav-collapse">
        <ul class="nav pull-right">
        <li><a href="http://hoosk.dev" target="_blank"><i class="icon-home"></i> View Site</a>
          <li class="dropdown"><a class="dropdown-toggle"  href="#" data-toggle="dropdown"><i
                            class="icon-cog"></i> admin <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/admin/users/edit/1">Profile</a></li>
              <!--<li><a href="javascript:;">Help</a></li>-->
            </ul>
          </li>
          <li><a href="http://hoosk.dev/admin/logout"><i class="icon-remove-sign "></i> Logout</a>
          </li>
         </ul>
      
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li class=""><a href="/admin"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-file"></i><span>Pages</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/pages">All Pages</a></li>
            <li><a href="/admin/pages/new">New Page</a></li>
          </ul>
        </li>
        <li class="dropdown active"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-edit"></i><span>Posts</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/posts">All Posts</a></li>
            <li><a href="/admin/posts/new">New Post</a></li>
            <li><a href="/admin/posts/categories">All Categories</a></li>
            <li><a href="/admin/posts/categories/new">New Category</a></li>
          </ul>
        </li>
        <li class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><span>Users</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/users">All Users</a></li>
            <li><a href="/admin/users/new">New User</a></li>
          </ul>
        </li>
        <li class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-list"></i><span>Navigation</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/admin/navigation">All Menus</a></li>
            <li><a href="/admin/navigation/new">New Navigation Menu</a></li>
          </ul>
        </li>
         <li class=""><a href="/admin/social"><i class="icon-share"></i><span>Social</span> </a> </li>
         <li class=""><a href="/admin/settings"><i class="icon-cog"></i><span>Settings</span> </a> </li>
       </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div><!--<link href="http://hoosk.dev/theme/admin/js/trevor/sir-trevor.css" rel="stylesheet"> -->


<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <div class="span12">
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Edit Post</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
            
            									
            									
			<form action="http://hoosk.dev/admin/posts/edited/1" id="contentForm" method="post" accept-charset="utf-8">
						<textarea name="content" cols="40" rows="10" id="content" class="js-st-instance" >{&quot;data&quot;:[{&quot;type&quot;:&quot;columns&quot;,&quot;data&quot;:{&quot;columns&quot;:[{&quot;width&quot;:6,&quot;blocks&quot;:[{&quot;type&quot;:&quot;text&quot;,&quot;data&quot;:{&quot;text&quot;:&quot;Brain freeze. Kinda hot in these rhinos. Here she comes to wreck the day. Brain freeze. Excuse me, I&#039;d like to ASS you a few questions. We&#039;re going for a ride on the information super highway. Your entrance was good, his was better. Kinda hot in these rhinos. It&#039;s because i&#039;m green isn&#039;t it! Here she comes to wreck the day. Alrighty Then Excuse me, I&#039;d like to ASS you a few questions. \n&quot;}}]},{&quot;width&quot;:6,&quot;blocks&quot;:[{&quot;type&quot;:&quot;text&quot;,&quot;data&quot;:{&quot;text&quot;:&quot;Your entrance was good, his was better. We got no food we got no money and our pets heads are falling off! Haaaaaaarry. Look at that, it&#039;s exactly three seconds before I honk your nose and pull your underwear over your head. It&#039;s because i&#039;m green isn&#039;t it! Hey, maybe I will give you a call sometime. Your number still 911? Excuse me, I&#039;d like to ASS you a few questions. \n&quot;}}]}],&quot;preset&quot;:&quot;columns-6-6&quot;}}]}</textarea>
					
                    <div class="form-actions">
                    <a class="btn btn-primary" data-toggle="modal" href="#attributes">Next</a>
					<a class="btn" href="http://hoosk.dev/admin/posts">Cancel</a>
				</div> <!-- /form-actions -->
             
                
                <!-- /widget-content --> 
            </div>
          </div>
          <!-- /widget -->
         
		<div id="attributes" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Post Attributes</h3>
            </div><div class="modal-body">
            <div class="control-group">
            <div class="alert alert-info">All fields marked with * are required!</div>	
            											
					<label class="control-label" for="postTitle">Post/Meta Title*</label>
					<div class="controls">
                    <input type="text" name="postTitle" value="Hello Hoosk." id="postTitle" class="span5"  />
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
				<div class="control-group">		
            											
					<label class="control-label" for="file_upload">Feature Image</label>
					<div class="controls">
						<div><img src="http://hoosk.dev/images/large_logo.png" id="logo_preloaded" ></div>
						<img src="http://hoosk.dev/theme/admin/images/ajax-loader.gif" style="margin:-7px 5px 0 5px;display:none;" id="loading_pic" />
						<input type="file" name="file_upload" id="file_upload" class="span5"  />
						<input type="hidden" id="postImage" name="postImage" />
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
              <div class="control-group">		
					<label class="control-label" for="postExcerpt">Excerpt*</label>
					<div class="controls">
						 <textarea name="postExcerpt" cols="40" rows="4" id="postExcerpt" class="span5" >Brain freeze. Kinda hot in these rhinos. Here she comes to wreck the day. Brain freeze. Excuse me, I&#039;d like to ASS you a few questions.</textarea>

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
               
				<div class="control-group">		
            											
					<label class="control-label" for="postURL">Post URL* (no spaces or special characters allowed)</label>
					<div class="controls">
						 <input type="text" name="postURL" value="hello_hoosk" id="postURL"  />

					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
                
			<div class="control-group">		
                									
					<label class="control-label" for="categoryID">Category</label>
					<div class="controls">
                        <select name="categoryID" id="categoryID" class="span5">
<option value="1" selected="selected">Uncategorized</option>
<option value="3">Hoosk Updates</option>
<option value="4">FAQs</option>
<option value="5">Test Category</option>
</select>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->  
            
                <div class="control-group">	
                    <div id="datetimepicker1" class="input-append date">
                    <label class="control-label" for="categoryID">Date</label>
                        <div class="controls">
                        <input type="text" name="datePosted" value="06/12/2014 01:12" id="datetimepicker" class="span5"  />
                        
                        
						 <input type="text" name="unixStamp" value="0" id="unixStamp" style="display:none;"  />
 
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Back</button>
            <a class="btn btn-primary" onClick="formSubmit()">Save</a>
            </div></div>
           </form>     </div>
      <!-- /span12 -->

      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>

<script src="http://hoosk.dev/theme/admin/js/date.js"></script>

<script type="text/javascript">
	jQuery('#datetimepicker').datetimepicker({
		format:'m/d/Y H:m:s'
			});
	new SirTrevor.Editor({ el: $('.js-st-instance'),
  	blockTypes: ["Columns", "Heading", "Text", "ImageExtended", "Quote", "Accordion", "Button", "Video", "List", "Iframe"]
	});
	SirTrevor.onBeforeSubmit();
</script>
<script type="text/javascript">
function formSubmit(){
	SirTrevor.onBeforeSubmit();
	var unixtime = Date.parse(document.getElementById('datetimepicker').value).getTime()/1000;
	document.getElementById("unixStamp").value = unixtime;
	document.getElementById("contentForm").submit();
}
</script>
<script type="text/javascript">
$(function () {
	
	if(document.getElementById('file_upload'))
		{
			function prepareUpload(event)
			{
				files = event.target.files;
				uploadFiles(event);
			}
	
			function uploadFiles(event)
			{
				event.stopPropagation();
				event.preventDefault();
	
				$('#loading_pic').show();
	
				var data = new FormData();
				$.each(files, function(key, value){ data.append(key, value); });
				
				$.ajax({
					url: 'http://hoosk.dev/admin/settings/submit/?files',
					type: 'POST',
					data: data,
					cache: false,
					dataType: 'json',
					processData: false,
					contentType: false,
					success: function(data, textStatus, jqXHR){
						if(data!='0')
						{
							$('#logo_preloaded').show();
							document.getElementById('logo_preloaded').src = 'http://hoosk.dev/uploads/' + data;
							document.getElementById('postImage').value = data;
							$('#loading_pic').hide();
						}
						else
							alert('Error! The file is not an image.');
					}
				});
			}
	
			function submitForm(event, data)
			{
				$form = $(event.target);
				var formData = $form.serialize();
				$.each(data.files, function(key, value){ formData = formData + '&filenames[]=' + value; });
	
				$.ajax({
					url: 'http://hoosk.dev/admin/settings/submit',
					type: 'POST',
					data: formData,
					cache: false,
					dataType: 'json',
					success: function(data, textStatus, jqXHR){
						if(typeof data.error === 'undefined')
							console.log('SUCCESS: ' + data.success);
						else
							console.log('ERRORS: ' + data.error);
					},
					error: function(jqXHR, textStatus, errorThrown){
						console.log('ERRORS: ' + textStatus);
					},
					complete: function()
					{
						$('#loading_pic').hide();
					}
				});
			}
			
			var files;
			$('input[type=file]').on('change', prepareUpload);
		}
	});	
</script>
<div class="push"></div>
</div>
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2015 <a href="http://hoosk.org/">Hoosk CMS</a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
</body>
</html>