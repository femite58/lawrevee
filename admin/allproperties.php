 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-bank"></i> All Properties     </h4>
                    
            </div>
                
                <div class="panel panel-body">

<div class="col-sm-12  " >
	 <a class="btn btn-primary btn-addon btn-md " href="?pg=newproperty"><i class="fa fa-plus"></i> Add Property</a>
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
             <th></th>
             <th>Name</th>
             <th>Location</th>
             <th>Neighborhood</th>
             <th>Land Size</th>
             <th>Title</th>
             <th>Price</th>
             <th>Promo</th>
             <th>Promo Start</th>
             <th>Promo End</th>
             <th>Use Type</th>
             <th>Added By</th>
             <th>Last Edit</th>
             <th>Edited By</th>
             <th>Status</th>
             <th>Action</th>
             
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($landid)){
                 $sn =1;
                 for($i=count($landid)-1; $i>=0; $i--){
					 $images = explode(",", genfetch("lands", $landid[$i], "images"));
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                 <td> <img class="thumbnail img" src="../img/<?php echo $images[0]; ?>" height="80px"/></td>
                 <td><?php echo genfetch("lands", $landid[$i], "name"); ?></td>
                 <td><?php echo genfetch("lands", $landid[$i], "location"); ?></td>
                 <td><?php echo genfetch("lands", $landid[$i], "neighborhood"); ?></td>
                 <td><?php echo genfetch("lands", $landid[$i], "size"); ?></td>
                 <td><?php echo genfetch("lands", $landid[$i], "title"); ?></td>
                 <td>N<?php echo number_format(genfetch("lands", $landid[$i], "price"),2); ?></td>
                 <td>N<?php echo number_format(genfetch("lands", $landid[$i], "promo"),2); ?></td>
                 <td><?php echo date("M/d/Y",genfetch("lands", $landid[$i], "promo_start")); ?></td>
                 <td><?php echo date("M/d/Y",genfetch("lands", $landid[$i], "promo_end")); ?></td>
                 <td><?php echo genfetch("lands", $landid[$i], "use_type"); ?></td>
				 <td><?php echo genfetch("admin", genfetch("lands", $landid[$i], "added_by"),"username"); ?></td>
                 <td><?php echo date("M-d-Y", genfetch("lands", $landid[$i], "last_edit")); ?></td>
                 <td><?php echo genfetch("admin", genfetch("lands", $landid[$i], "edit_by"),"username"); ?></td>
                 <td></td>
                 <td><a href="?pg=editproperty&pkid=<?php echo $landid[$i]; ?>" class="btn btn-sm btn-info">Edit</a></td>
                 
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Properties</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               