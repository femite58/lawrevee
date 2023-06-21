 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-users"></i> All Investors     </h4>
                    
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
             <th>First Name</th>
             <th>Surname</th>
             <th>Other Names</th>
             <th>Email</th>
             <th>Phone</th>
             <th>Address</th>
             <th>Sex</th>
             <th>Marital Status</th>
             <th>Nationality</th>
             <th>Next of Kin First Name</th>
             <th>Next of Kin Surame</th>
             <th>Next of Kin Phone</th>
             <th>Next of Kin Address</th>
             <th>Date Registered</th>
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($usrid)){
                 $sn =1;
                 for($i=count($usrid)-1; $i>=0; $i--){
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "first_name"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "surname"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "middle_name"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "email"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "phone"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "address"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "sex"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "marital_status"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "nationality"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "kin_first_name"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "kin_surname"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "kin_phone"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "kin_address"); ?></td>
                 <td><?php echo genfetch("users", $usrid[$i], "date"); ?></td>
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Customers</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               