<?php

namespace classes;

class User
{
    public $err;
    public $succ;

    public $db;
    public $response;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveNewUser(array $data)
    {
        $name = $this->db->realString($data['name']);
        $address1 = $this->db->realString($data['address1']);
        $address2 = $this->db->realString($data['address2']);
        $area = $this->db->realString($data['area']);
        $city = $this->db->realString($data['city']);
        $postcode = $this->db->realString($data['postcode']);
        $state = $this->db->realString($data['state']);
        $country = $this->db->realString($data['country']);
        $telephone = $this->db->realString($data['telephone']);
        $mosque_id = $this->db->realString($data['mosque_id']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($name)) {
            $this->response['message'] = 'Please enter user name';
        } elseif (!preg_match('/[A-Za-z]/', $name)) {
            $this->response['message'] = "User name must be Alphabetical";
        } elseif ($this->db->checkUniqe("all_members", 'name', $name)) {
            $this->response['message'] = "User already exists!";
        } elseif (empty($address1)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($address2)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($area)) {
            $this->response['message'] = "Please enter Area!";
        } elseif (empty($city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($postcode)) {
            $this->response['message'] = "Post code is required!";
        } elseif (empty($state)) {
            $this->response['message'] = "State is required!";
        } elseif (empty($country)) {
            $this->response['message'] = "Please enter Country!";
        } elseif (empty($telephone)) {
            $this->response['message'] = "Telephone is required!";
        }

        if (!isset($this->response['message'])) {
            $sql = "INSERT INTO `all_members`(`name`, `mosque_id`, `address1`, `address2`, `area`, `city`, `postcode`, `state`, `country`, `telephone`) VALUES ('$name', '$mosque_id', '$address1','$address2','$area','$city','$postcode','$state','$country','$telephone')";
            $query = $this->db->runquery($sql);
            $Identification_id = $this->db->lastid();
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'User added successfully';
            } else {
                $this->response['message'] = 'User could not be saved!';
            }
        }
        return $this->response;
    }

    public function makeAsnaf(array $data)
    {
        $agency_name = $this->db->realString($data['agency_name']);
        $agency_id = $this->db->realString($data['agency_id']);
        $mosque_id = $this->db->realString($data['mosque_id']);
        $Identification_id = $data['Identification_id'];

        $sql = "INSERT INTO `asnaf`(`Identification_id`, `mosque_id`, `agancy_name`, `agency_id`) VALUES ('$Identification_id','$mosque_id','$agency_name','$agency_id')";
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($this->db->runquery($sql)) {
            $this->response['status'] = 1;
            $this->response['type'] = 'success';
            $this->response['message'] = 'Asnaf selected successfully';
        } else {
            $this->response['message'] = 'Something is wrong please try again!';
        }
        return $this->response;
    }

    public function makeCommittee($data)
    {
        $mosque_id = $this->db->realString($data['mosque_id']);
        $asnaf_name = $this->db->realString($data['asnaf_name']);
        $position = $this->db->realString($data['position']);
        $password = $this->db->realString($data['password']);
        $Identification_id = $data['Identification_id'];
        if (empty($mosque_id) || empty($asnaf_name) || empty($position) || empty($password)) {
            $this->response['message'] = "Filedes are required!";
        } elseif ($this->db->checkUniqe("commitee", 'asnaf_name', $asnaf_name)) {
            $this->response['message'] = "Login Id already already exists!";
        }
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($this->response['message'])) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `commitee`(`Identification_id`, `mosque_Id`, `asnaf_name`, `position`, `password`) VALUES ('$Identification_id','$mosque_id','$asnaf_name','$position','$password')";
            if ($this->db->runquery($sql)) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Committee selected successfully';
            } else {
                $this->response['message'] = 'Something is wrong please try again!';
            }
        }
        return $this->response;
    }

    public function updateData(array $data)
    {
        $name = $this->db->realString($data['name']);
        $address1 = $this->db->realString($data['address1']);
        $address2 = $this->db->realString($data['address2']);
        $area = $this->db->realString($data['area']);
        $city = $this->db->realString($data['city']);
        $postcode = $this->db->realString($data['postcode']);
        $state = $this->db->realString($data['state']);
        $country = $this->db->realString($data['country']);
        $telephone = $this->db->realString($data['telephone']);
        $mosque_id = $this->db->realString($data['mosque_id']);
        $Identification_id = $this->db->realString($data['Identification_id']);

        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (empty($name)) {
            $this->response['message'] = 'Please enter user name';
        } elseif (!preg_match('/[A-Za-z]/', $name)) {
            $this->response['message'] = "User name must be Alphabetical";
        } elseif ($this->db->checkUniqe("all_members", 'name', $name, 'Identification_id', $Identification_id)) {
            $this->response['message'] = "User already exists!";
        } elseif (empty($address1)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($address2)) {
            $this->response['message'] = "Must enter Address 1!";
        } elseif (empty($area)) {
            $this->response['message'] = "Please enter Area!";
        } elseif (empty($city)) {
            $this->response['message'] = "City is required!";
        } elseif (empty($postcode)) {
            $this->response['message'] = "Post code is required!";
        } elseif (empty($state)) {
            $this->response['message'] = "State is required!";
        } elseif (empty($country)) {
            $this->response['message'] = "Please enter Country!";
        } elseif (empty($telephone)) {
            $this->response['message'] = "Telephone is required!";
        }

        if (!isset($this->response['message'])) {
            $sql = "UPDATE `all_members` SET `name`='$name',`mosque_id`='$mosque_id',`address1`='$address1',`address2`='$address2',`area`='$area',`city`='$city',`postcode`='$postcode',`state`='$state',`country`='$country',`telephone`='$telephone' WHERE `Identification_id`='$Identification_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['url'] = 'members.php';
                $this->response['message'] = 'User Upadated successfully';
            } else {
                $this->response['message'] = 'User could not be Updated!';
            }
        }
        return $this->response;
    }

    public function deleteData(array $data)
    {
        $Identification_id = $data['Identification_id'];
        $select = $this->db->runquery("SELECT * FROM `commitee` WHERE `Identification_id`='$Identification_id'");
        $select2 = $this->db->runquery("SELECT * FROM `asnaf` WHERE `Identification_id`='$Identification_id'");
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if ($select->num_rows > 0 || $select2->num_rows > 0) {
            $this->response['message'] = 'First remove from asnaf or committee!';
        }
        if (!isset($this->response['message'])) {
            $sql = "DELETE FROM `all_members` WHERE `Identification_id`='$Identification_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Member Deleted successfully';
                $this->response['row'] = '#row' . $Identification_id;
            } else {
                $this->response['message'] = 'Member could not be deleted!';
            }
        }
        return $this->response;
    }

    public function deleteAsnaf(array $data)
    {
        $asnaf_id = $data['asnaf_id'];
        $this->response['status'] = 0;
        $this->response['type'] = 'error';
        if (!isset($this->response['message'])) {
            $sql = "DELETE FROM `asnaf` WHERE `asnaf_id`='$asnaf_id'";
            $query = $this->db->runquery($sql);
            if ($query) {
                $this->response['status'] = 1;
                $this->response['type'] = 'success';
                $this->response['message'] = 'Member Deleted successfully';
                $this->response['row'] = '#row' . $asnaf_id;
            } else {
                $this->response['message'] = 'Member could not be deleted!';
            }
        }
        return $this->response;
    }
}
