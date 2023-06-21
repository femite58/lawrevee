 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          <h4>    <i class="fa fa-user"></i> New Staff   </h4>
                    
            </div>
                
                <div class="panel panel-body">
       
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
           
                   
         <div class="form-group">
          <label class="col-sm-4 control-label">Name</label>
          <div class="col-sm-6">
			  <input  name="staffname" class="form-control" required>
          </div>
        </div>  
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Phone</label>
          <div class="col-sm-6">
			  <input  name="staffphone" class="form-control" required>
          </div>
        </div> 
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Email</label>
          <div class="col-sm-6">
			  <input  name="staffemail" class="form-control" type="email" required>
          </div>
        </div> 
         
						<div class="form-group">
          <label class="col-sm-4 control-label">username</label>
          <div class="col-sm-6">
			  <input  name="staffusername" class="form-control" type="text" required>
          </div>
        </div> 
         
						<div class="form-group">
          <label class="col-sm-4 control-label">Password</label>
          <div class="col-sm-6">
			  <input  name="staffpassword" class="form-control" type="password" required>
          </div>
        </div> 
						
		
						<div class="form-group">
          <label class="col-sm-4 control-label">Staff Level</label>
          <div class="col-sm-6">
			  <select  name="stafflevel" class="form-control" type="text" required>
				  <option value="1">Admin</option>
				  <option value="0">Regular Staff </option>
				 
			  </select>
          </div>
        </div> 
		
         
                <div class="row text-center">
          <button type="submit" class="btn btn-success font-bold m">Save</button>
          <a class="btn btn-danger font-bold m" href="?pg=staffs">Cancel</a>
                    
        </div>
                   </form>
                    </div>
                    </div>
               