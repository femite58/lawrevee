 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-user"></i> New Library   </h4>
                    
            </div>
                
                <div class="panel panel-body">
       
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Title</label>
          <div class="col-sm-6">
			  <input  name="librarytitle" class="form-control" required>
          </div>
        </div>  
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Category</label>
          <div class="col-sm-6">
			  <select  name="librarycategory" class="form-control" required>
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
			  <input  name="libraryvideo" class="form-control" type="text" >
          </div>
        </div> 
         
         
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Save</button>
          <a class="btn btn-danger font-bold m" href="?pg=alllibrary">Cancel</a>
                    
        </div>
                   </form>
                    </div>
                    </div>
               