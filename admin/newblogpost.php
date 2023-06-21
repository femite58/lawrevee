 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-file"></i> New Blog Post      </h4>
                    
            </div>
                
                <div class="panel panel-body">
       <div class="col-sm-8 ">
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Topic</label>
          <div class="col-sm-8">
			  <input  name="topicbg" class="form-control" required>
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Category</label>
          <div class="col-sm-8">
			  
			  <input  name="categorybg" class="form-control" required>
			
          </div>
        </div>
                   
						<div class="form-group">
          <label class="col-sm-4 control-label">Tags</label>
          <div class="col-sm-8">
			  <input  name="tagsbg" data-role="tagsinput" placeholder="Seperate tags with comma" class="form-control" required>
          </div>
        </div>
                   
                  <div class="form-group">
          <label class="col-sm-4 control-label">Content</label>
          <div class="col-sm-8">
			  <textarea  name="contentbg" class="" id="jsckeditor"></textarea>
              
          </div>
        </div>
                   
                    
       
                
                
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Post</button>
          <a class="btn btn-danger font-bold m" href="?pg=allblogposts">Cancel</a>
                    
        </div>
                   </form>
					</div>
					
	   <div class="col-sm-4 ">
			    <div class="col-sm-12" style='border:1px solid #eee; border-radius:5px; padding-top:10px;'>
			 <h5 class="mt-10">Insert Images</h5>
			 <hr>
			 <div class="col-sm-12 row" style="margin-top:-20px;">
			     <form method="post" action="" enctype="multipart/form-data" id="myform">
			         <div class="form-group">
			             <div class="col-sm-11 row">
            <input type="file" id="file" name="file" class="form-control"/>
            </div>
            <div class="col-sm-1 row">
            <input type="button" class="btn btn-success btn-sm" value="Upload" id="but_upload"></div>
        </div>
			     </form>
			     <hr>
			     </div>
			 <div class="col-sm-12" id="imglist">
			     
			 </div>
			    </div>
			    </div>
                    </div>
	   
                    </div>
               