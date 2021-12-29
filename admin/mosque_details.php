<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
if (isset($_GET['mosque'])) {
    $mosque_id = $_GET['mosque'];
} else {
    header('location:./mosque.php');
}
$sql = "SELECT * FROM `mosques` WHERE `mosque_id`='$mosque_id'";
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
                    </div>
                    <?php
                }
                if ($count > 0) {
                    $i = 1;
                    while ($row = $select->fetch_assoc()) {
                        $name = $row['mosque_name'];
                        $address1 = $row['address1'];
                        $address2 = $row['address2'];
                        $area = $row['area'];
                        $city = $row['city'];
                        $state = $row['state'];
                        $postcode = $row['postcode'];
                        $country = $row['country'];
                    ?>
                        <div class="row mb-3">
                            <div class="col-12 mb-3">Name : <?= $name ?></div>
                            <div class="col-12 mb-3">Address 1 : <?= $address1 ?></div>
                            <div class="col-12 mb-3">Address 2 : <?= $address2 ?></div>
                            <div class="col-12 mb-3">Area : <?= $area ?></div>
                            <div class="col-12 mb-3">City : <?= $city ?></div>
                            <div class="col-12 mb-3">State : <?= $state ?></div>
                            <div class="col-12 mb-3">Post Code : <?= $postcode ?></div>
                            <div class="col-12 mb-3">Country : <?= $country ?></div>
                        </div>
                    <?php
                        $i++;
                    }
                } else {
                    ?>
                    <h4>No members found</h4>
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