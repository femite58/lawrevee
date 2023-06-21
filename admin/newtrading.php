 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-money"></i> New Estate Trading   </h4>
                    
            </div>
                
                <div class="panel panel-body">
       
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" >
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Estate Name</label>
          <div class="col-sm-6">
			  <input  name="tradingname" class="form-control" required>
          </div>
        </div>  
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Location</label>
          <div class="col-sm-6">
			 <input  name="tradinglocation" class="form-control" required>
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Price per Plot</label>
          <div class="col-sm-6">
			  <input  name="tradingpriceplot" class="form-control" type="number"  step=".01" required>
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Price per Square Meter </label>
          <div class="col-sm-6">
			   <input  name="tradingpricemeter" class="form-control" type="number"  step=".01" required>
          </div>
        </div> 
						
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Save</button>
          <a class="btn btn-danger font-bold m" href="?pg=trading">Cancel</a>
                    
        </div>
                   </form>
                    </div>
                    </div>
               