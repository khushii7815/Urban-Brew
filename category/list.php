<?php 
	  if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     } 
?>
		 <style>
    body {
        background-image: url('https://images.pexels.com/photos/10069511/pexels-photo-10069511.jpeg?auto=compress&cs=tinysrgb&w=600'); /* Background image */
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
            <h1 class="page-header" style='color:black; font-weight:bold'>List of Categories  <a href="index.php?view=add" class="btn btn-primary btn-s  ">  <i class="fa fa-plus-circle fw-fa"></i> Add Category</a>  </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
	 		    <form action="controller.php?action=delete" Method="POST">  
					<div class='table-container'>

			     <div class="table-responsive">					
				<table id="dash-table" class="table table-striped table-bordered table-hover"  style="font-size:12px" cellspacing="0">
				
				  <thead>
				  	<tr>
				  		<!-- <th>No.</th> -->
				  		<th style="font-size: 15px;">
				  		 <!-- <input type="checkbox" name="chkall" id="chkall" onclick="return checkall('selector[]');">  -->
				  		 Category</th> 
				  		 <th width="25%" style="text-align: center; font-size: 15px;">Action</th>
				  	</tr>	
				  </thead> 
				  <tbody>
				  	<?php 
				  		$mydb->setQuery("SELECT * FROM `tblcategory`");
				  		$cur = $mydb->loadResultList();

						foreach ($cur as $result) {
				  		echo '<tr>';
				  		// echo '<td width="5%" align="center"></td>';
				  		// echo '<td>
				  		//      <input type="checkbox" name="selector[]" id="selector[]" value="'.$result->CATEGORYID. '"/>
				  		// 		' . $result->CATEGORIES.'</a></td>';
				  			echo '<td style="font-size:15px;">' . $result->CATEGORY.'</td>';
				  		echo '<td align="center">
				  		     <a title="Remove" href="controller.php?action=delete&id='.$result->CATEGORYID.'" class="btn btn-danger btn-s  ">  <span class="fa  fa-trash-o "> Remove </a></td>';
				  		// echo '<td></td>';
				  		echo '</tr>';
				  	} 
				  	?>
				  </tbody>
					
				</table>
						<div class="btn-group">
				 <!--  <a href="index.php?view=add" class="btn btn-default">New</a> -->
					<?php
					if($_SESSION['ADMIN_ROLE']=='Administrator'){
					// echo '<button type="submit" class="btn btn-default" name="delete"><span class="glyphicon glyphicon-trash"></span> Delete Selected</button'
					; }?>
				</div>
					</div>
					</div>
			
			
				</form>
	
 <div class="table-responsive">	 