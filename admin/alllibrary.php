 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-photo"></i> All Library     </h4>
                    
            </div>
                
                <div class="panel panel-body">

<div class="col-sm-12  " >
	 <a class="btn btn-primary btn-addon btn-md " href="?pg=newlibrary"><i class="fa fa-plus"></i> Add To Library</a>
          </div>
				
                    
    <div class="col-sm-12">
         <table class="table table-striped table-hover" id="customers2">
                <thead>
             <th>S/N</th>
             <th>Title</th>
             <th>Category</th>
             <th>Action</th>
             
             
              
             </thead>
             
             <tbody>
                 <?php
                 if(isset($lby)){
                 $sn =1;
                 for($i=count($lby)-1; $i>=0; $i--){
					
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                 <td><?php echo genfetch("library", $lby[$i], "title"); ?></td>
                 <td><?php echo genfetch("library", $lby[$i], "category"); ?></td>
                
                 <td><a href="?pg=editlibrary&pkid=<?php echo $lby[$i]; ?>" class="btn btn-sm btn-info">Edit</a>
                 
                     <?php if(genfetch("library", $lby[$i], "active")==1){ ?>
                     <form method="post">
                     <input type="hidden" value="<?php echo $lby[$i]; ?>" name="hidelibrary">
                         <button class="btn btn-sm btn-danger">Hide</button>
                     </form>
                     <?php
                      }else {
                              ?>
                      <form method="post">
                     <input type="hidden" value="<?php echo $lby[$i]; ?>" name="showlibrary">
                         <button class="btn btn-sm btn-success">Show</button>
                     </form>
                     <?php
                                             }
                     ?>
                 </td>
                 
                 
               
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="16">No Content</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               