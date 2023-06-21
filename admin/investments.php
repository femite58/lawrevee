 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-money"></i> All Investments     </h4>
                    
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
             <th>Investor</th>
             <th>Location</th>
             <th>Estate</th>
             <th>Size</th>
             <th>Value</th>
             <th>Expected Profit</th>
             <th>Duration</th>
             <th>Final Value</th>
             <th>Maturity</th>
             
             <th>Status</th>
            
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($invid)){
                 $sn =1;
                 for($i=count($invid)-1; $i>=0; $i--){
					
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                
                 <td><?php echo genfetch("users",genfetch("investments", $invid[$i], "user"), "first_name")." ".genfetch("users",genfetch("investments", $invid[$i], "user"), "middle_name")." ".genfetch("users",genfetch("investments", $invid[$i], "user"), "surname"); ?></td>
                 <td><?php echo genfetch("trading",genfetch("investments", $invid[$i], "property"), "location"); ?></td>
                 <td><?php echo genfetch("trading", genfetch("investments", $invid[$i], "property"), "estate"); ?></td>
                 <td><?php echo genfetch("investments", $invid[$i], "qty"); ?> Sq. Meters</td>
                  
                 <td>N<?php echo number_format(genfetch("investments", $invid[$i], "price"),2); ?></td>
                 <td>N<?php echo number_format((genfetch("investments", $invid[$i], "price")*genfetch("investments", $invid[$i], "interest_rate")/100),2); ?></td>
				 <td><?php echo genfetch("investments", $invid[$i], "duration"); ?></td>
                 <td>N<?php echo number_format(genfetch("investments", $invid[$i], "price")+(genfetch("investments", $invid[$i], "price")*genfetch("investments", $invid[$i], "interest_rate")/100),2); ?></td>
                  <td><?php echo date("M-d-Y", genfetch("investments", $invid[$i], "due_date")); ?></td>
                  <td><?php echo genfetch("investments", $invid[$i], "status"); ?></td>
                 
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Investment</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               