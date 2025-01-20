<?php 
if (!isset($_SESSION['ADMIN_USERID'])) {
    redirect(web_root."admin/index.php");
} 
?>
<style>
    body {
        background-image: url('https://images.pexels.com/photos/1307698/pexels-photo-1307698.jpeg'); /* Background image */
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
        <h1 class="page-header" style="color:white; font-weight: bold;">Tables List  
            <a href="controller.php?action=add" class="btn btn-primary btn-s" style="background-color: #007bff; color: white;">
                <i class="fa fa-plus-circle fw-fa"></i> Add New Table
            </a>
        </h1>
    </div>
</div>

<form action="controller.php?action=delete" method="POST">  
    <div class="table-container">
        <div class="table-responsive 
		" style="margin-top: 20px; ">                    
            <table id="dash-table" class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead style="background-color: #007bff; color: white;">
                    <tr>
                        <th style="font-size: 16px; text-align: center; padding: 10px;">Table Number</th>
                        <th style="font-size: 16px; padding: 10px;">Customer Name</th> 
                        <th style="font-size: 16px; padding: 10px;">Time</th>
                        <th style="font-size: 16px; text-align: center; padding: 10px;">Status</th>
                        <th style="font-size: 16px; text-align: center; padding: 10px;">Action</th>
                    </tr>    
                </thead> 
                <tbody>
                    <?php 
                    $mydb->setQuery("SELECT * FROM `tbltable` ORDER BY TABLENO ASC");
                    $cur = $mydb->loadResultList();

                    foreach ($cur as $result) {
                        echo '<tr style="border-bottom: 1px solid #ddd;">'; 

                        // Set variables based on the status
                        if ($result->STATUS == 'Reserved') {
                            $btn = "Cancel";
                            $url = "controller.php?action=reserve&id=".$result->TABLEID;
                            $customer = $result->CUSTOMER;
                        } elseif ($result->STATUS == 'Available') {
                            $btn = "Reserve";
                            $url = "index.php?view=add&id=".$result->TABLEID;
                            $customer = "";
                        } elseif ($result->STATUS == 'Occupied') {
                            $btn = "Occupied";
                            $url = "#"; // No action for occupied
                            $customer = "";
                        }

                        echo '<td style="font-size: 18px; text-align:center; font-weight:bold; padding: 10px;">' . $result->TABLENO . '</td>';
                        echo '<td style="font-size: 18px; padding: 10px;">' . $customer . '</td>';
                        echo '<td style="font-size: 18px; padding: 10px;">' . ($result->STATUS == 'Reserved' ? $result->RESERVEDTIME : '') . '</td>';
                        echo '<td style="font-size: 18px; text-align:center; padding: 10px;">' . $result->STATUS . '</td>';

                        echo '<td align="center" style="padding: 10px;">
                            <a title="'.$btn.'" href="'.$url.'" class="btn btn-success btn-sm" style="background-color: #28a745; color: white; margin-right: 5px; border-radius: 5px; padding: 5px 10px;">
                                <span class="fa fa-bookmark fw-fa"> '.$btn.'</span>
                            </a>
                            <a title="Remove" href="controller.php?action=delete&id='.$result->TABLEID.'" class="btn btn-danger btn-sm" style="background-color: #dc3545; color: white; border-radius: 5px; padding: 5px 10px;">
                                <span class="fa fa-trash-o fw-fa"> Remove</span>
                            </a>
                        </td>';

                        echo '</tr>';
                    } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</form>
