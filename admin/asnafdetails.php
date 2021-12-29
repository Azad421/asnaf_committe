<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
if (isset($_GET['asnaf'])) {
    $asnaf_id = $_GET['asnaf'];
} else {
    header('location:./asnaf.php');
}
$sql = "SELECT * FROM `asnaf` INNER JOIN `mosques` ON `asnaf`.`mosque_Id`=`mosques`.`mosque_id` INNER JOIN `all_members` ON `asnaf`.`Identification_id`=`all_members`.`Identification_id` WHERE `asnaf_id`='$asnaf_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$name = $row['name'];

?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body px-5">
            <div class="col-sm-8 col-12 col-md-6 mx-auto" id="printContent" data-title="<?= $name ?>">
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
                    $Identification_id = $row['Identification_id'];
                    $name = $row['name'];
                    $telephone = $row['telephone'];
                    $mosque_name = $row['mosque_name'];
                    $agancy_name = $row['agancy_name'];
                    $agency_id = $row['agency_id'];
                    $address1 = $row['address1'];
                    $address2 = $row['address2'];
                    $area = $row['area'];
                    $state = $row['state'];
                ?>
                    <div class="row mb-3">
                        <div class="col-12 mb-3">Name : <?= $name ?></div>
                        <div class="col-12 mb-3">Mosque Name : <?= $mosque_name ?></div>
                        <div class="col-12 mb-3">Address1 : <?= $address1 ?></div>
                        <div class="col-12 mb-3">Address2 : <?= $address2 ?></div>
                        <div class="col-12 mb-3">Area : <?= $area ?></div>
                        <div class="col-12 mb-3">State : <?= $state ?></div>
                        <div class="col-12 mb-3">Telephone : <?= $telephone ?></div>
                        <div class="col-12 mb-3">Agency Name : <?= $agancy_name ?></div>
                        <div class="col-12 mb-3">Agency Id : <?= $agency_id ?></div>
                    </div>
                <?php
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