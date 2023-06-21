 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-users"></i> Staff Levels     </h4>
                    
            </div>
                
                <div class="panel panel-body">
<div class="col-sm-12  " >
	 <a class="btn btn-primary btn-addon btn-md " href="?pg=newlevel"><i class="fa fa-plus"></i> Add Staff Level</a>
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
             <th>Level</th>
             <th>Privileges</th>
             <th>Action</th>
            
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($privid)){
                 $sn =1;
                 for($i=count($privid)-1; $i>=0; $i--){
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                 <td><?php echo genfetch("staff_levels", $privid[$i], "level"); ?></td>
                 <td><?php echo genfetch("staff_levels", $privid[$i], "privileges"); ?></td>
                 <td></td>
                
                
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Privileges</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               