 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-clock-o"></i> Inspection Schedule     </h4>
                    
            </div>
                
                <div class="panel panel-body">

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
             <th>Property</th>
             <th>Name</th>
             <th>Phone</th>
             <th>Email</th>
             <th>Date</th>
             <th>Time</th>
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($insid)){
                 $sn =1;
                 for($i=count($insid)-1; $i>=0; $i--){
					
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                
                 <td><?php echo genfetch("lands",genfetch("inspection", $insid[$i], "land"), "name"); ?></td>
                 
                 <td><?php echo genfetch("inspection", $insid[$i], "name"); ?> </td>
                 <td><?php echo genfetch("inspection", $insid[$i], "phone"); ?> </td>
                 <td><?php echo genfetch("inspection", $insid[$i], "email"); ?> </td>
                 <td><?php echo date("d-M-Y",genfetch("inspection", $insid[$i], "date")); ?> </td>
                 <td><?php echo genfetch("inspection", $insid[$i], "time"); ?> </td>
                  
                
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Inspection</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               