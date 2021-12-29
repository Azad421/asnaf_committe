<?php
include_once("./php/autoload.php");
$title = "Asnaf Commitee";
include('partials/checkloggedin.php');
include('partials/header.php');
$sql = "SELECT * FROM `asnaf` INNER JOIN `all_members` ON `asnaf`.`Identification_id`=`all_members`.`Identification_id`  WHERE `asnaf`.`mosque_id` = $mosque_id ORDER BY `area` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body" id="printContent" data-title="<?= $mosque_name ?>">
            <?php if ($count > 0) { ?>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                        <span class="text-white">Print</span>
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="row">
                <div class="col-2 col-sm-1 p-1 text-right p-0">No</div>
                <div class="col-10 col-sm-11 p-1 p-0">
                    <div class="row mb-3">
                        <div class="col-md-3">Name</div>
                        <div class="col-md-5">
                            Address
                        </div>
                        <div class="col-md-2">Telephone</div>
                    </div>
                </div>
            </div>
            <?php
            if ($count > 0) {
                $i = 1;
                while ($member = $select->fetch_assoc()) {
                    $Identification_id = $member['Identification_id'];
                    $name = $member['name'];
                    $address1 = $member['address1'];
                    $address2 = $member['address2'];
                    $area = $member['area'];
                    $city = $member['city'];
                    $state = $member['state'];
                    $postcode = $member['postcode'];
                    $country = $member['country'];
                    $telephone = $member['telephone'];
                    $asnaf_id = $member['asnaf_id'];
            ?>
                    <div class="row">
                        <div class="col-2 col-sm-1 p-1 text-right">
                            <?= $i . '.' ?>
                        </div>
                        <div class="col-10 col-sm-11 p-1">
                            <div class="row mb-3">
                                <div class="col-md-3"><?= $name ?></div>
                                <div class="col-md-5">
                                    <?= $address1 . ", " . $address2 . ", " . $area . ", " . $city . ", " . $postcode . ", " . $state . ", "  . $country ?>
                                </div>
                                <div class="col-md-2"><?= $telephone ?></div>
                                <div class="col-md-2 save_as"><a href="asnafdetails.php?asnaf=<?= $asnaf_id ?>" class="btn btn-success">View Details</a></div>
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                //     }
                // }
            } else {
                ?>
                <h4>No members found</h4>
            <?php
            }

            ?>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>