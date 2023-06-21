 <?php
  $pkid = sanitizeInput($_GET["pkid"]);
  ?>
 <div class="panel panel-default table-responsive card-view">
   <div class="panel-heading">
     <h4> <i class="fa fa-bank"></i> Edit Property </h4>

   </div>

   <div class="panel panel-body">

     <form class="form-horizontal" method="post" enctype="multipart/form-data">


       <div class="form-group">
         <label class="col-sm-4 control-label">Estate Name</label>
         <div class="col-sm-6">
           <input name="landid" type="hidden" required value="<?php echo  $pkid; ?>">
           <input name="estatenameed" class="form-control" required value="<?php echo genfetch("lands", $pkid, "name"); ?>">
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-4 control-label">Location</label>
         <div class="col-sm-6">
           <input name="estatelocationed" class="form-control" required value="<?php echo genfetch("lands", $pkid, "location"); ?>">
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-4 control-label">Neighborhood</label>
         <div class="col-sm-6">
           <input name="estateneighborhooded" class="form-control" required value="<?php echo genfetch("lands", $pkid, "neighborhood"); ?>">
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-4 control-label">Land Size (Sqm)</label>
         <div class="col-sm-6">
           <input name="estatesizeed" class="form-control" type="number" required value="<?php echo genfetch("lands", $pkid, "size"); ?>">
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-4 control-label">Popular</label>
         <div class="col-sm-6">
         <select name="popular" class="form-control" value="<?php echo genfetch("lands", $pkid, "popular"); ?>" required>
             <option value="1">True</option>
             <option value="0">False</option>
           </select>
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-4 control-label">Title</label>
         <div class="col-sm-6">
           <input name="estatetitleed" class="form-control" required value="<?php echo genfetch("lands", $pkid, "title"); ?>">
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-4 control-label">Price</label>
         <div class="col-sm-6">
           <input name="estatepriceed" class="form-control" type="number" step=".01" required value="<?php echo genfetch("lands", $pkid, "price"); ?>">
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-4 control-label">Promo Price</label>
         <div class="col-sm-6">
           <input name="estatepromoed" class="form-control" type="number" step=".01" value="<?php echo genfetch("lands", $pkid, "promo"); ?>">
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-4 control-label">Promo Start</label>
         <div class="col-sm-6">
           <input name="estatepromostarted" class="form-control" type="date" value="<?php echo date("Y-m-d", genfetch("lands", $pkid, "promo_start")); ?>">
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-4 control-label">Promo End</label>
         <div class="col-sm-6">
           <input name="estatepromoended" class="form-control" type="date" value="<?php echo date("Y-m-d", genfetch("lands", $pkid, "promo_end")); ?>">
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-4 control-label">Purchase Form</label>
         <div class="col-sm-6">
           <input name="estateform" class="form-control" type="file">
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-4 control-label">Use Type</label>
         <div class="col-sm-6">
           <select name="estateusetypeed" class="form-control" required>
             <option value="<?php echo genfetch("lands", $pkid, "use_type"); ?>"><?php echo genfetch("lands", $pkid, "use_type"); ?></option>
             <option value="Commercial">Commercial</option>
             <option value="Residential">Residential</option>
             <option value="Agriculture">Agriculture</option>
           </select>
         </div>
       </div>


       <div class="form-group">
         <label class="col-sm-4 control-label">Images</label>
         <div class="col-sm-6 " id="uploads">

           <?php

            $images = explode(",", genfetch("lands", $pkid, "images"));

            for ($i = 0; $i < count($images); $i++) {
            ?>
             <div class="col-sm-3 mb-5">
               <input name="imgold[]" type="checkbox" checked class="check_box" value="<?php echo $images[$i]; ?>" /> <img class="thumbnail img" src="../img/<?php echo $images[$i]; ?>" height="80px" />
             </div>
           <?php
            }
            ?>
           <div class="col-sm-3 mb-5">

             <input name="prodimg[]" type="file" data-height="150" data-width="150" class="dropify" multiple />

           </div>

         </div>

       </div>
       <div class="form-group">
         <label class="col-sm-4 control-label"></label>
         <div class="col-sm-6 ">
           <a class="btn btn-info btn-sm" onclick="addimage('#uploads')">+ Add Image</a>
         </div>

       </div>


       <div class="form-group">
         <label class="col-sm-4 control-label">Youtube Video Link</label>
         <div class="col-sm-6">
           <input name="estatevideoed" class="form-control" type="text" value="<?php echo genfetch("lands", $pkid, "video"); ?>">
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-4 control-label">Description</label>
         <div class="col-sm-6">
           <textarea name="estatedescriptioned" class="tinymce"><?php echo genfetch("lands", $pkid, "description"); ?></textarea>
         </div>
       </div>

       <script>
         function addimage(id) {
           $(id).append("<div class=\"col-sm-3 mb-5\"><input name=\"prodimg[]\" type=\"file\" data-height=\"150\"  class=\"dropify\" multiple/></div>");

           $('.dropify').dropify();
         }
       </script>

       <div class="row text-center">
         <button type="submit" class="btn btn-success font-bold m">Save</button>
         <a class="btn btn-danger font-bold m" href="?pg=properties">Cancel</a>

       </div>
     </form>
   </div>
 </div>