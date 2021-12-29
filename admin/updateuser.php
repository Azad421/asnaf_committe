<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee";
include('./partials/header.php');
if (isset($_GET['user'])) {
    $Identification_id = $_GET['user'];
} else {
    header('./members.php');
}
$sql = "SELECT * FROM `all_members` WHERE `all_members`.`Identification_id`='$Identification_id'";
$select = $db->runquery($sql);
$user = $select->fetch_assoc();
$Identification_id = $user['Identification_id'];
$name = $user['name'] ?? '';
$address1 = $user['address1'] ?? '';
$address2 = $user['address2'] ?? '';
$area = $user['area'] ?? '';
$city = $user['city'] ?? '';
$state = $user['state'] ?? '';
$postcode = $user['postcode'] ?? '';
$country = $user['country'] ?? '';
$country = $user['country'] ?? "";
$telephone = $user['telephone'] ?? "";
$mosque_id = $user['mosque_id'] ?? "";
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update User</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="update_user">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="mosque_id">Select Mosque</label>
                            <select name="mosque_id" class="form-control" id="mosque_id">
                                <option value="">Select Mosque</option>
                                <?php
                                $sql = "SELECT * FROM `mosques`";
                                $select = $db->runquery($sql);
                                if ($select->num_rows > 0) {
                                    while ($row = $select->fetch_assoc()) {
                                ?>
                                        <option value="<?= $row['mosque_id'] ?>" <?= $core->itemSelected($row['mosque_id'], $mosque_id) ?>><?= $row['mosque_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address1">Address 1</label>
                            <input type="text" class="form-control" id="address1" name="address1" value="<?= $address1 ?>" placeholder="Address 1">
                        </div>
                        <div class="form-group">
                            <label for="address2">Address 2</label>
                            <input type="text" class="form-control" id="address2" name="address2" value="<?= $address2 ?>" placeholder="Address 2">
                        </div>
                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" id="area" name="area" class="form-control" value="<?= $area ?>" placeholder="Area">

                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" value="<?= $city ?>" placeholder="City">
                        </div>
                        <div class="form-group">
                            <label for="postcode">Post Code</label>
                            <input type="text" id="postcode" name="postcode" value="<?= $postcode ?>" class="form-control" placeholder="Post Code">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" value="<?= $state ?>" class="form-control" placeholder="State">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" value="<?= $country ?>" class="form-control" placeholder="Country">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" id="telephone" name="telephone" value="<?= $telephone ?>" class="form-control" placeholder="Telephone">
                        </div>
                        <input type="hidden" name="Identification_id" value="<?= $Identification_id ?>">
                        <input type="hidden" name="update_user" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('form#update_user').submit(function(e) {
        e.preventDefault();
        var formid = $(this);
        submitForm(e, formid, isAdded);
    });

    function isAdded(response) {
        if (response.status == 1) {
            setTimeout(() => {
                window.location.href = response.url;
            }, 3000);
        }
    };
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>