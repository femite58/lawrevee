  <?php
$pkid = sanitizeInput($_GET["pkid"]);
?>
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-money"></i> Edit Estate Trading   </h4>
                    
            </div>
                
                <div class="panel panel-body">
       
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" >
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Estate Name</label>
          <div class="col-sm-6">
			  <input  name="tid" class="form-control" type="hidden" required value="<?php echo $pkid; ?>">
			  <input  name="tradingnameed" class="form-control" required value="<?php echo genfetch("trading", $pkid, "estate"); ?>">
          </div>
        </div>  
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Location</label>
          <div class="col-sm-6">
			 <input  name="tradinglocationed" class="form-control" required value="<?php echo genfetch("trading", $pkid, "location"); ?>">
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Price per Plot</label>
          <div class="col-sm-6">
			  <input  name="tradingpriceploted" class="form-control" type="number"  step=".01" required value="<?php echo genfetch("trading", $pkid, "price_per_plot"); ?>">
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Price per Square Meter </label>
          <div class="col-sm-6">
			   <input  name="tradingpricemetered" class="form-control" type="number"  step=".01" required value="<?php echo genfetch("trading", $pkid, "price_per_meter"); ?>">
          </div>
        </div> 
						
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Save</button>
          <a class="btn btn-danger font-bold m" href="?pg=trading">Cancel</a>
                    
        </div>
                   </form>
                    </div>
                    </div>
               