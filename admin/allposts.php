 
   <div class="panel panel-default table-responsive card-view">
		<div class="panel-heading">
          
			<h4>    <i class="fa fa-file"></i> All Blog Posts     </h4>
                    
            </div>
                
                <div class="panel panel-body">

<div class="col-sm-12  " >
          <a class="btn btn-primary btn-addon btn-md " href="?pg=newblog"><i class="fa fa-plus"></i> Add New Post</a>
          </div>
                    
    <div class="col-sm-12">
         <table class="table table-striped table-hover">
                <thead>
             <th>S/N</th>
             <th>Topic</th>
             <th>Category</th>
             <th>Tags</th>
             <th>Views</th>
             <th>Likes</th>
             <th>Date Added</th>
             <th>Actions</th>
             
             
             
             </thead>
             
             <tbody>
                 <?php
                 if(isset($pidblg)){
                 $sn =1;
                 for($i=count($pidblg)-1; $i>=0; $i--){
                                             ?>
             <tr>
                 <td><?php echo $sn; ?></td>
                   <td><?php echo genfetch("blog", $pidblg[$i], "topic"); ?></td>
                   <td><?php echo genfetch("blog", $pidblg[$i], "category"); ?></td>
                   <td><?php echo genfetch("blog", $pidblg[$i], "tags"); ?></td>
                   <td><?php echo genfetch("blog", $pidblg[$i], "views"); ?></td>
                   <td><?php echo genfetch("blog", $pidblg[$i], "likes"); ?></td>
                   <td><?php echo genfetch("blog", $pidblg[$i], "date"); ?></td>
                
                 <td><a class="btn btn-xs btn-info" href="?pg=editblog&pkid=<?php echo  $pidblg[$i]; ?>"> Edit</a>
					 
						<a href="../blog/readpost.php?rp=<?php echo getblogtopicurl($bid[$i]); ?>" class="btn btn-xs btn-warning" ><i class="fa fa-eye"></i> View Post</a>
								
									
								<a onclick="publish(<?php echo $pidblg[$i]; ?>);" class="btn btn-xs btn-info <?php if(getblogpublish($pidblg[$i])==1){echo 'hide';} ?>" id="pdpublish<?php echo $pidblg[$i]; ?>"><i class="fa fa-tag"></i> Publish</a>
								
								<a onclick="unpublish(<?php echo $pidblg[$i]; ?>)" class="btn btn-xs btn-warning <?php if(getblogpublish($pidblg[$i])==0){echo 'hide';} ?>"  id="pdunpublish<?php echo $pidblg[$i]; ?>"><i class="fa fa-tag"></i> Unpublish</a>
									
				 </td>
                 
                
                 </tr>
                 
                 <?php $sn +=1;}
                 
                 }else{?>
                 <tr>
                 <td colspan="6">No Tracks</td>
                 </tr>
                 <?php } ?>
             </tbody>
                </table>
                    
                    </div>
                    </div>
                    </div>
              
                    
    
               