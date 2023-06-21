 <div class="panel panel-default table-responsive card-view">
     <div class="panel-heading">

         <h4> <i class="fa fa-flag"></i> All Top Slides </h4>

     </div>

     <div class="panel panel-body">

         <div class="col-sm-12  ">
             <a class="btn btn-primary btn-addon btn-md " href="?pg=newtopslide"><i class="fa fa-plus"></i> Add Top Slide</a>
         </div>

         <div class="col-sm-12">
             <table class="table table-striped table-hover" id="customers2">
                 <thead>
                     <th>S/N</th>
                     <th></th>

                     <th>Action</th>



                 </thead>

                 <tbody>
                     <?php
                        if (isset($tsld)) {
                            $sn = 1;
                            for ($i = count($tsld) - 1; $i >= 0; $i--) {

                        ?>
                             <tr>
                                 <td><?php echo $sn; ?></td>
                                 <td> <img class="thumbnail img" src="../img/<?php echo genfetch("topslide", $tsld[$i], "img"); ?>" height="80px" /></td>

                                 <td><a href="?pg=edittopslide&pkid=<?php echo $tsld[$i]; ?>" class="btn btn-sm btn-info">Edit</a>


                                     <?php if (genfetch("topslide", $tsld[$i], "active") == 1) { ?>
                                         <form method="post">
                                             <input type="hidden" value="<?php echo $tsld[$i]; ?>" name="hidetopslide">
                                             <button class="btn btn-sm btn-danger">Hide</button>
                                         </form>
                                     <?php
                                        } else {
                                        ?>
                                         <form method="post">
                                             <input type="hidden" value="<?php echo $tsld[$i]; ?>" name="showtopslide">
                                             <button class="btn btn-sm btn-success">Show</button>
                                         </form>
                                     <?php
                                        }
                                        ?>
                                 </td>




                             </tr>

                         <?php $sn += 1;
                            }
                        } else { ?>
                         <tr>
                             <td colspan="16">No Slides</td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>

         </div>
     </div>
 </div>