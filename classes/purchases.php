<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/20/2019
 * Time: 9:55 PM
 */
require_once 'db.php';


class Purchases
{
    private $id;
    private $user_id;
    private $ticket_id;
    private $amount;
    private $cost;
    private $created_at;


    private static $table = 'tickets_purchased';

    /**
     * Purchases constructor.
     * @param $id
     * @param $user_id
     * @param $ticket_id
     * @param $amount
     * @param $created_at
     */
    public function customConstruct($id, $user_id, $ticket_id, $amount, $cost, $created_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->ticket_id = $ticket_id;
        $this->amount = $amount;
        $this->cost = $cost;
        $this->created_at = $created_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getTicketId()
    {
        return $this->ticket_id;
    }

    public function setTicketId($ticket_id)
    {
        $this->ticket_id = $ticket_id;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }


    public function createPurchase()
    {
        if (isset($_POST)) {
            $total_cost = floatval($_POST['totalcost']);
            echo $total_cost;
            $tickets = array();
            foreach ($_POST as $value) {
                if (is_array($value)) {
                    $tickets[] = $value;
                }
            }
            $db = new dataBase();
            $user_id = $_SESSION['id'];
            foreach ($tickets as $ticket) {

                $ticket_id = $ticket['id'];
                $amount = $ticket['amount'];
                $cost = $ticket['cost'];
                $sql = "INSERT INTO project_eventus.tickets_purchased (user_id, ticket_id, amount,cost) 
            VALUES ('$user_id','$ticket_id','$amount','$cost')";
                $db->setSql($sql);
                $db->execQuery();

                $sql = "UPDATE project_eventus.tickets SET amount=amount-'$amount' WHERE id='$ticket_id'";
                $db->setSql($sql);
                $db->execQuery();

            }
            $sql = "UPDATE project_eventus.user SET account_bal=account_bal-'$total_cost' WHERE id='$user_id'";
            $db->setSql($sql)->execQuery();

            $sql= "SELECT account_bal FROM project_eventus.user where id=".$user_id;
            $db->setSql($sql)->execQuery();
            while ($row = mysqli_fetch_assoc($db->getResult())){
                $_SESSION['account_bal']=$row['account_bal'];

            }
            if (!$db->getResult()) {
                setMessage('PURCHASE FAILED : ' . $db->getConn()->error, 'error');
            } else {
                setMessage('PURCHASE REGISTERED SUCCESSFULLY', 'success');
            }
            $db->freeRes();

            $db->close();

        }


    }

    public function deletePurchase()
    {
        if (isset($_GET['id'])) {
            $db = new dataBase();
            $id = $_GET['id'];
            $result = $db->deleteRecord($id, self::$table);
            if ($result) {
                setMessage('DELETE PURCHASE SUCCESSFUL', 'success');
            } else {
                setMessage('DELETE PURCHASE FAILED!', 'error');
            }
            $db->close();
        }

    }

    public function updatePurchase()
    {
        $db = new dataBase();
        if (isset($_GET['id'])) {
            if (isset($_POST)) {

                extract($_POST);

                $sql = "UPDATE " . self::$table . " SET `user_id`=" . $user_id . ",`ticket_id`=" . $ticket_id . ",`amount`=" . $amount . ",
                        `cost`=" . $cost;
                $result = $db->setSql($sql)->execQuery();
                if ($result) {
                    setMessage('UPDATE TICKET SUCCESSFUL', 'success');
                } else {
                    setMessage('UPDATE TICKET FAILED!', 'error');
                }
            }
            $db->close();
        }
    }


    public function displayPurchases($id = '')
    {
        $db = new dataBase();
        $sql = "SELECT  `id`, `category` , `price`, `amount`,`event_id`,`created_at`
               FROM project_eventus.tickets";
        if (!empty($id)) {
            $sql .= " WHERE `user_id`=" . $id;
        }

        $purchases = $db->setSql($sql)->getResults(__CLASS__);

        //FIELDS
        $db->setTableFields()->disPlayFields();


        //ROWS
        echo '<tbody>';
        foreach ($purchases as $purchase) {
            echo '<tr>
                     <td>' . $purchase->getId() . '</td>
                     <td>' . $purchase->getUserId() . '</td>
                     <td>' . $purchase->getTicketId() . '</td>
                     <td>' . $purchase->getAmount() . '</td>
                     <td>' . $purchase->getCost() . '</td>
                     <td>' . $purchase->getCreatedAt() . '</td>
                 </tr>';
        }
        echo '</tbody></table>';
        $db->freeRes();
        $db->close();
    }


}
