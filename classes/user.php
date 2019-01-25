<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/20/2019
 * Time: 9:55 PM
 */
require_once 'db.php';

class User
{
    private $id;
    private $fname;
    private $lname;
    private $email;
    private $photo;
    private $account_bal;
    private $created_at;
    private $role;
    private static $table = 'user';

    public function getId()
    {
        return $this->id;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getAccountBal()
    {
        return $this->account_bal;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setFname($fname)
    {
        $this->fname = $fname;
        return $this;
    }

    public function setLname($lname)
    {
        $this->lname = $lname;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
        return $this;
    }

    public function setAccountBal($account_bal)
    {
        $this->account_bal = $account_bal;
        return $this;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }


    /**
     * User constructor.
     * @param $id
     * @param $fname
     * @param $lname
     * @param $email
     * @param $photo
     * @param $account_bal
     * @param $created_at
     * @param $role
     */
    public function customConstruct($id, $fname, $lname, $email, $photo, $account_bal, $created_at, $role)
    {
        $this->id = $id;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->email = $email;
        $this->photo = $photo;
        $this->account_bal = $account_bal;
        $this->created_at = $created_at;
        $this->role = $role;
    }


    public function createUser()
    {
        if (isset($_POST['save'])) {
            extract($_POST);
            if (!isset($role_id)) {
                $role_id = '2';
            } else if (empty($account_bal)) {
                $account_bal = '0';
            }

            $trail = saveImage('users', 'photo');
            $db = new dataBase();
            $sql = "INSERT INTO project_eventus.user (fname, lname, email, photo, password, account_bal,role_id)
                   VALUES ('$fname', '$lname', '$email', '$trail', '$password', '$account_bal','$role_id')";
            $db->setSql($sql)->execQuery();

            if (!$db->getResult()) {
                setMessage('USER REGISTRATION FAILED : ' . $db->getConn()->error, 'error');
            } else {
                setMessage('USER REGISTERED SUCCESSFULLY , now login', 'success');
            }
            $db->close();
        }
    }

    public function deleteUser()
    {
        if (isset($_GET['id'])) {
            $db = new dataBase();
            $id = $_GET['id'];
            $result = $db->deleteRecord($id, self::$table);
            if ($result) {
                setMessage('DELETE USER SUCCESSFUL', 'success');
            } else {
                setMessage('DELETE USER FAILED!'.$db->getConn()->error, 'error');
            }
            $db->close();
        }
    }

    public function updateUser($id)
    {
        $db = new dataBase();
            if (isset($_POST)) {

                extract($_POST);
                if (!$role_id) {
                    $role_id = '2';
                } else if (!$account_bal) {
                    $account_bal = '0';
                }

                $trail = saveImage('users', 'photo');
                $sql = "UPDATE " . self::$table . " SET  `fname`='$fname',`lname`='$lname',
                        `email`='$email',`photo`='$trail', `password`='$password', `account_bal`='$account_bal',`role_id`='$role_id'
                        WHERE `id` =".$id;
                $result = $db->setSql($sql)->execQuery()->getResult();
                if ($result) {
                    setMessage('UPDATE USER SUCCESSFUL', 'success');
                } else {
                    setMessage('UPDATE USER FAILED! '.$db->getConn()->error, 'error');
                }
            }

        $db->close();
    }


    public function displayUsers($id='')
    {
        $db = new dataBase();


        $sql = "SELECT u.`id`,u.`fname`,u.`lname`,u.`email`,u.`photo`,u.`account_bal` , u.`created_at` , role.`name` AS `role` 
                  FROM  project_eventus.user u 
                  INNER JOIN project_eventus.role ON u.role_id = role.id ";
        if (!empty($id)){
            $sql.= " WHERE `id`=".$id;
        }
        $users = $db->setSql($sql)->getResults(__CLASS__);
if (!isset($users)){
    {
        setMessage('FAILED! '.$db->getConn()->error, 'error');
    }
}
        //FIELDS
        $db->setTableFields()->disPlayFields();


        //ROWS
        echo '<tbody>';
        foreach ($users as $user) {
            echo '<tr>
                     <td class="id-cell">' . $user->getId() . '</td>
                     <td class="nam1">' . $user->getFname() . '</td>
                     <td class="nam2">' . $user->getLname() . '</td>
                     <td>' . $user->getEmail() . '</td>
                     <td>' . displayImage($user->getPhoto()) . '</td>
                     <td>' . $user->getAccountBal() . '</td>
                     <td>' . $user->getCreatedAt() . '</td>
                     <td>' . $user->getRole() . '</td>
                     <td><a role="button" class="btn btn-outline-danger" href="#deleteModal" data-toggle="modal" aria-controls="deleteModal" class="btn btn-outline-danger">Delete</a>
                         <a href="./edit_user.php?id='.$user->getId().'" role="button" class="btn btn-outline-info"  aria-controls="editModal">Edit</a>
                     </td>
                 </tr>';
        }
        echo '</tbody></table></div>';
        $db->freeRes();
        $db->close();
    }


}
