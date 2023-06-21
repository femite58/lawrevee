 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-users"></i> All Staffs     </h4>
                    
            </div>
                
                <div class="panel panel-body">
<div class="col-sm-12  " >
	 <a class="btn btn-primary btn-addon btn-md " href="?pg=newstaff"><i class="fa fa-plus"></i> Add Staff</a>
          </div>
<div class="col-sm-12  " >
          <div class="btn-group pull-right m-t-15">
                            <button type="button" class="btn btn-success dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Export <span class="m-l-5"><i class="fa fa-bars"></i></span></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});">XLS</a></li>
                                <li><a href="#" onClick ="$('#customers2').tableExport({type:'csv',escape:'false'});">CSV</a></li>
                                <li><a href="#" onClick ="$('#customers2').tableExport({type:'doc',escape:'false'});">WORD</a></li>
                               
                                <li><a href="#" onClick ="$('#customers2').tableExport({type:'txt',escape:'false'});">TXT</a></li>
                            </ul>
                        </div>
          </div>
                    
    <div class="col-sm-12">
         <table class="table table-striped table-hover" id="customers2">
                <thead>
             <th>S/N</th>
             <th>Name</th>
             <th>username</th>
             <th>Email</th>
             <th>Phone</th>
             <th>Level</th>
             <th>Status</th>
             <th>Date Added</th>
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($staid)){
                 $sn =1;
                 for($i=count($staid)-1; $i>=0; $i--){
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                 <td><?php echo genfetch("admin", $staid[$i], "name"); ?></td>
                 <td><?php echo genfetch("admin", $staid[$i], "username"); ?></td>
                 <td><?php echo genfetch("admin", $staid[$i], "email"); ?></td>
                 <td><?php echo genfetch("admin", $staid[$i], "phone"); ?></td>
                 <td><?php if(genfetch("admin", $staid[$i], "admins")=="1"){echo "Admin";}else{echo "Regular Staff"; } ?></td>
                 <td><?php if(genfetch("admin", $staid[$i], "active")=="1"){echo "Active";}else{echo "Suspended"; } ?></td>
                 
                 <td><?php echo genfetch("admin", $staid[$i], "date"); ?></td>
                
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Staffs</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               