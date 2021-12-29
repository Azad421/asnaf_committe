<?php

namespace classes;

class Core
{
    public $bd;

    public function __construct($db)
    {
        $this->db = $db;
    }




    public function user_role($role)
    {
        switch ($role) {
            case 1:
                return "Admin";
                break;
            case 2:
                echo "Branch";
                break;
            case 3:
                echo "Manager";
                break;
            case 4:
                echo "Staff";
                break;
            default:
                echo "User don't have any role!";
        }
    }


    public function status($status)
    {
        $status = strtolower($status);
        switch ($status) {
            case 'active':
                return '<span class="badge badge-pill badge-success">Active</span>';
                break;
            case 'approved':
                return '<span class="badge badge-pill badge-success">Approved</span>';
                break;
            case "inactive":
                return '<span class="badge badge-pill badge-danger">Inactive</span>';
                break;
            case "pending":
                return '<span class="badge badge-pill badge-warning">Pending</span>';
                break;
            case "rejected":
                return '<span class="badge badge-pill badge-danger">Rejected</span>';
                break;
            default:
                return "No Status Found!";
        }
    }

    public function valuepost($attrname)
    {
        if (isset($_POST[$attrname])) {
            return $_POST[$attrname];
        } else {
            return false;
        }
    }

    public function postSelected($attrname, $value = null)
    {
        if (isset($_POST[$attrname])) {
            if ($_POST[$attrname] == $value) {
                return "selected";
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function itemSelected($item, $value = null)
    {
        if ($item == $value) {
            return "selected";
        } else {
            return false;
        }
    }

    public function itemChecked($items, $itemarry, $value = null)
    {
        foreach ($items as $key => $item) {
            if ($value == null) {
                if (!in_array($item, $itemarry)) {
                    return $item;
                }
            } else {
                if ($item == $value) {
                    return 'checked';
                }
            }
        }
        return false;
    }
}
