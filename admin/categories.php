<?php 
require_once("top.inc.php");
if (isset($_GET["type"] )&& $_GET["type"]!="") {
    $type = get_safe_value($_GET["type"]);
    if ($type==="status") {
        $operation = get_safe_value($_GET["operation"]);
        $id = get_safe_value($_GET["id"]);
        if($operation == "active")
            $status = 1;
            else
            $status = 0;
        $sql = "UPDATE categories set status = '$status' Where id = '$id'";
        mysqli_query($con,$sql);
    }
    if ($type==="delete") {
        $id = get_safe_value($_GET["id"]);
        $sql = "DELETE FROM categories Where id = '$id'";
        mysqli_query($con,$sql);
    }
}
$sql = "SELECT * FROM categories ORDER BY categories ASC";
$res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
    <div class="orders">
       <div class="row">
          <div class="col-xl-12">
             <div class="card">
                <div class="card-body">
                   <h4 class="box-title">Categories</h4>
                   <h3><a style="color:#4DABF7; cursor:pointer;" href="manage_categories.php"><i class="fas fa-plus-square"></i></a></h3>
                </div>
                <div class="card-body--">
                   <div class="table-stats order-table ov-h">
                      <table class="table ">
                         <thead>
                            <tr>
                               <th class="serial">#</th>
                               <th>ID</th>
                               <th>Categories</th>
                               <th>Status</th>
                            </tr>
                         </thead>
                         <tbody>
                             <?php
                             $serial = 1;
                             while ($row = mysqli_fetch_assoc($res)) {
                             ?>
                            <tr>
                               <td class="serial"><?php echo $serial++ ?></td>
                               <td><?php echo $row["id"]?></td>
                               <td><?php echo $row["categories"]?></td>
                               <td><?php 
                               if($row["status"] == 1){
                                   echo "<a class='crud' id='active' href='?type=status&operation=deactive&id=$row[id]'>Active</a>&nbsp;";
                               }else{
                                   echo "<a class='crud' id='deactive' href='?type=status&operation=active&id=$row[id]'>Deactive</a>&nbsp;";
                               }
                               echo "<a  class='crud' id='update' href='manage_categories.php?id=$row[id]'><i class='fas fa-pen'></i></a>&nbsp;";
                               echo "<a  class='crud' id='delete' href='?type=delete&id=$row[id]'><i class='fas fa-trash'></i></a>&nbsp;";
                               ?></td>
                            </tr>
                            <?php }?>
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>
<?php require_once("footer.inc.php")?>