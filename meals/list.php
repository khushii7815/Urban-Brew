<?php
   if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."index.php");
     }

		check_message(); 
		?> 
		 <style>
    body {
        background-image: url('https://img.freepik.com/free-photo/vegetables-set-left-black-slate_1220-685.jpg?size=626&ext=jpg&ga=GA1.1.1174229373.1727168465&semt=ais_hybrid'); /* Background image */
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat; 
        margin: 0; 
        padding: 20px; 
    }


    .table-container {
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
        padding: 20px; 
        border-radius: 10px; 
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
    }
</style>
		<div class="row">
       	 <div class="col-lg-12">
            <h1 class="page-header" style="color:white; font-weight: bold;">List of Meals <a href="index.php?view=add" class="btn btn-primary btn-s  ">  <i class="fa fa-plus-circle fw-fa"></i> Add Meal</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
			    <form action="controller.php?action=delete" Method="POST"> 
					    <div class="table-container"> 	
			    <div class="table-responsive"" style="margin-top: 20px; ">				
				<table id="dash-table"  class="table table-striped table-bordered table-hover "  style="font-size:12px" cellspacing="0" >
					
				  <thead style="font-size: 18px;">
				  	<tr>  
				  		<th style="text-align: center;">Photo</th>  
				  		<th>Meal Description</th>
				  		<th>Categories</th>  
				  		<th>Price</th> 
				  		<th style="text-align: center;">Action</th> 
						<!-- <th style="text-align: center;">Description</th>  -->

					</tr>	
				  </thead> 	

			  <tbody>
				  	<?php 
				  		$query = "SELECT * FROM `tblmeals` m , `tblcategory` c
           					 WHERE  m.`CATEGORYID` = c.`CATEGORYID` ORDER BY CATEGORIES ";
				  		$mydb->setQuery($query);
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) { 
				  		echo '<tr>';
				  		// echo '<td width="3%" align="center"></td>';
				    	echo '<td width="100px">
							<a class="MEALID" href="#" data-target="#menuModal"  data-toggle="modal"  data-id="'.$result->MEALID.'"> 
							<img  title="Change Photo" width="100px" height="40px" src="'.web_root.'meals/'.$result->MEALPHOTO . '">
							</a></td>'; 	 
				  		echo '<td style="font-size:15px;">'.$result->MEALS.'</a></td>';
				  		
				  		echo '<td style="font-size:15px; width:100px">'. $result->CATEGORY.'</td>'; 
				  		echo '<td style="font-size:15px;" width="100px"> &#8369 '.  number_format($result->PRICE,2).'</td>';  

				  	 	echo '<td align="center" width="230px">  
				  		     <a title="Remove" href="controller.php?action=delete&id='.$result->MEALID.'" class="btn btn-danger btn-s  ">  <span class="fa  fa-trash-o fw-fa "> Remove</a></td>';
				  	} 
				  	?>
				  </tbody>
				</table>

				<!-- <div class="btn-group">
				  <a href="index.php?view=add" class="btn btn-default">New</a>
				  <button type="submit" class="btn btn-default" name="delete"><i class="fa fa-trash fw-fa"></i> Delete Selected</button>
				</div> -->

				</div>
				</div>
				</form>
 
					 <div class="modal fade" id="menuModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal" type=
                                    "button">x</button>

                                    <h4 class="modal-title" id="myModalLabel">Image.</h4>
                                </div>

                                <form action="<?php echo web_root; ?>admin/meals/controller.php?action=photos" enctype="multipart/form-data" method=
                                "post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="rows">
                                                <div class="col-md-12">
                                                    <div class="rows">
                                                        <div class="col-md-8"> 
                                                            <input class="mealid" type="hidden" name="mealid" id="mealid" value="">
                                                              <input name="MAX_FILE_SIZE" type="hidden" 
                                                              value="1000000"> 
                                                              <input id="photo" name="photo" type="file">
                                                        </div>

                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-default" data-dismiss="modal" type=
                                        "button">Close</button> <button class="btn btn-primary"
                                        name="savephoto" type="submit">Upload Photo</button>
                                    </div>
                                </form>
                            </div><!-- /.modal-content
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->  

   