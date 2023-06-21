 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-money"></i> All Estate Trading     </h4>
                    
            </div>
                
                <div class="panel panel-body">

<div class="col-sm-12  " >
	 <a class="btn btn-primary btn-addon btn-md " href="?pg=newtrading"><i class="fa fa-plus"></i> Add Estate Trading</a>
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
             <th>Location</th>
             <th>Price per Plot</th>
             <th>Price per Sq. Meter</th>
             <th>Added By</th>
             <th>Last Edit</th>
             <th>Edited By</th>
             <th>Status</th>
             <th>Action</th>
             
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($trdid)){
                 $sn =1;
                 for($i=count($trdid)-1; $i>=0; $i--){
					
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                
                 <td><?php echo genfetch("trading", $trdid[$i], "estate"); ?></td>
                 <td><?php echo genfetch("trading", $trdid[$i], "location"); ?></td>
                 
                 <td>N<?php echo number_format(genfetch("trading", $trdid[$i], "price_per_plot"),2); ?></td>
                 <td>N<?php echo number_format(genfetch("trading", $trdid[$i], "price_per_meter"),2); ?></td>
                 <td><?php echo genfetch("admin", genfetch("trading", $trdid[$i], "added_by"),"username"); ?></td>
                 <td><?php echo date("M-d-Y", genfetch("trading", $trdid[$i], "last_edit")); ?></td>
                 <td><?php echo genfetch("admin", genfetch("trading", $trdid[$i], "edit_by"),"username"); ?></td>
                
                 <td></td>
                 <td><a href="?pg=edittrading&pkid=<?php echo $trdid[$i]; ?>" class="btn btn-sm btn-info">Edit</a></td>
                 
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Estate Trading</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               