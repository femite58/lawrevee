 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-bank"></i> New Property   </h4>
                    
            </div>
                
                <div class="panel panel-body">
       
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" >
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Estate Name</label>
          <div class="col-sm-6">
			  <input  name="estatename" class="form-control" required>
          </div>
        </div>  
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Location</label>
          <div class="col-sm-6">
			 <input  name="estatelocation" class="form-control" required>
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Neighborhood</label>
          <div class="col-sm-6">
			  <input  name="estateneighborhood" class="form-control"  required>
          </div>
        </div> 
							
						<div class="form-group">
          <label class="col-sm-4 control-label">Land Size</label>
          <div class="col-sm-6">
			  <input  name="estatesize" class="form-control" required>
          </div>
        </div> 	
						<div class="form-group">
          <label class="col-sm-4 control-label">Title</label>
          <div class="col-sm-6">
			  <input  name="estatetitle" class="form-control" required>
          </div>
        </div> 
						<div class="form-group">
          <label class="col-sm-4 control-label">Price</label>
          <div class="col-sm-6">
			  <input  name="estateprice" class="form-control" type="number"  step=".01" required>
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Promo Price</label>
          <div class="col-sm-6">
			   <input  name="estatepromo" class="form-control" type="number"  step=".01" >
          </div>
        </div> 
						
						<div class="form-group">
          <label class="col-sm-4 control-label">Promo Start</label>
          <div class="col-sm-6">
			  <input  name="estatepromostart" class="form-control" type="date"  >
          </div>
        </div> 
					<div class="form-group">
          <label class="col-sm-4 control-label">Promo End</label>
          <div class="col-sm-6">
			  <input  name="estatepromoend" class="form-control" type="date" >
          </div>
        </div> 
					
					<div class="form-group">
          <label class="col-sm-4 control-label">Purchase Form</label>
          <div class="col-sm-6">
			  <input  name="estateform" class="form-control" type="file"  required >
          </div>
        </div> 
					
					<div class="form-group">
          <label class="col-sm-4 control-label">Use Type</label>
          <div class="col-sm-6">
			  <select  name="estateusetype" class="form-control"   required >
				  <option value="Commercial">Commercial</option>
				  <option value="Residential">Residential</option>
				  <option value="Agriculture">Agriculture</option>
			  </select>
          </div>
        </div> 
					
					
						<div class="form-group">
          <label class="col-sm-4 control-label">Images</label>
          <div class="col-sm-6 " id="uploads">
          <div class="col-sm-3 mb-5">
         
			<input name="prodimg[]" type="file" data-height="150" data-width="150" class="dropify"  multiple/>
											
							</div>
			  
							</div>
							
                 </div> 
						<div class="form-group">
          <label class="col-sm-4 control-label"></label>
          <div class="col-sm-6 ">
					<a class="btn btn-info btn-sm" onclick="addimage('#uploads')">+ Add Image</a>	
			  </div>
			  
							</div>
						
			
					<div class="form-group">
          <label class="col-sm-4 control-label">Youtube Video Link</label>
          <div class="col-sm-6">
			  <input  name="estatevideo" class="form-control" type="text" >
          </div>
        </div> 				
						<div class="form-group">
          <label class="col-sm-4 control-label">Description</label>
          <div class="col-sm-6">
			  <textarea  name="estatedescription" class="tinymce"  ></textarea>
          </div>
        </div> 
						
		<script>
			
						function addimage(id){
							$(id).append("<div class=\"col-sm-3 mb-5\"><input name=\"prodimg[]\" type=\"file\" data-height=\"150\"  class=\"dropify\" multiple/></div>");
							
							$('.dropify').dropify();
						}
						</script>
         
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Save</button>
          <a class="btn btn-danger font-bold m" href="?pg=properties">Cancel</a>
                    
        </div>
                   </form>
                    </div>
                    </div>
               