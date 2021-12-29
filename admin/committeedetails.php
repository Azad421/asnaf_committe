<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
if (isset($_GET['committee'])) {
    $committee_id = $_GET['committee'];
} else {
    header('location:./committee.php');
}
$sql = "SELECT * FROM `commitee` INNER JOIN `mosques` ON `commitee`.`mosque_Id`=`mosques`.`mosque_id` INNER JOIN `all_members` ON `commitee`.`Identification_id`=`all_members`.`Identification_id` WHERE `committee_id`='$committee_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;

?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body px-5">
            <div class="col-sm-8 col-12 col-md-6 mx-auto" id="printContent" data-title="Asnaf List">
                <?php if ($count > 0) { ?>
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                            <span class="text-white">Print</span>
                        </a>
                        <span class="printdate">Printed on: <?= date('d/m/Y'); ?></span>
                    </div>
                    <?php
                }
                if ($count > 0) {
                    $i = 1;
                    while ($row = $select->fetch_assoc()) {
                        $Identification_id = $row['Identification_id'];
                        $name = $row['name'];
                        $telephone = $row['telephone'];
                        $position = $row['position'];
                        $asnaf_name = $row['asnaf_name'];
                        $mosque_name = $row['mosque_name'];
                    ?>
                        <div class="row mb-3">
                            <div class="col-12 mb-3">Name : <?= $name ?></div>
                            <div class="col-12 mb-3">Login Id : <?= $asnaf_name ?></div>
                            <div class="col-12 mb-3">Mosque Name : <?= $mosque_name ?></div>
                            <div class="col-12 mb-3">Telephone : <?= $telephone ?></div>
                            <div class="col-12 mb-3">Position : <?= $position ?></div>
                        </div>
                    <?php
                        $i++;
                    }
                } else {
                    ?>
                    <h4 class="text-center mb-0">No members found</h4>
                <?php
                }

                ?>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>