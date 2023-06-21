   <?php
$pkid = sanitizeInput($_GET["pkid"]);
?>
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-user"></i> Edit Library   </h4>
                    
            </div>
                
                <div class="panel panel-body">
       
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Title</label>
          <div class="col-sm-6">
               <input  name="libid" type="hidden" value="<?php echo $pkid; ?>" class="form-control" required>
			  <input  name="librarytitleed" class="form-control" required value="<?php echo genfetch("library", $pkid, "title"); ?>">
          </div>
        </div>  
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Category</label>
          <div class="col-sm-6">
			  <select  name="librarycategoryed" class="form-control" required>
				  <option value="<?php echo genfetch("library", $pkid, "category"); ?>"><?php echo genfetch("library", $pkid, "category"); ?></option>
				  <option value="picture">picture</option>
				  <option value="video">video</option>
			  </select>
          </div>
        </div> 
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Image</label>
          <div class="col-sm-6">
			  <input  name="libraryfile" class="form-control" type="file" >
          </div>
        </div> 
         
						<div class="form-group">
          <label class="col-sm-4 control-label">Video Link</label>
          <div class="col-sm-6">
			  <input  name="libraryvideoed" class="form-control" type="text">
          </div>
        </div> 
         
         
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Save</button>
          <a class="btn btn-danger font-bold m" href="?pg=alllibrary">Cancel</a>
                    
        </div>
                   </form>
                    </div>
                    </div>
               