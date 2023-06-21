    <?php
$pkid = sanitizeInput($_GET["pkid"]);
?>
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-user"></i> Edit Top Slide   </h4>
                    
            </div>
                
                <div class="panel panel-body">
       
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Image</label>
          <div class="col-sm-6">
			  <input  name="slideid" type="hidden" value="<?php echo $pkid; ?>" class="form-control" required>
			  <input  name="slidefileed" type="file" class="form-control" required>
          </div>
        </div>  
		
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Save</button>
          <a class="btn btn-danger font-bold m" href="?pg=alltopslide">Cancel</a>
                    
        </div>
                   </form>
                    </div>
                    </div>
               