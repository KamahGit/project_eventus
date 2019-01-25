<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/20/2019
 * Time: 9:55 PM
 */
require_once 'db.php';


class Ticket
{
    private $id;
    private $category;
    private $price;
    private $amount;
    private $event_id;
    private $created_at;

    private static $table = 'tickets';

    /**
     * Ticket constructor.
     * @param $id
     * @param $category
     * @param $price
     * @param $amount
     * @param $event_id
     * @param $created_at
     */
    public function customConstruct($id, $category, $price, $amount, $event_id, $created_at)
    {
        $this->id = $id;
        $this->category = $category;
        $this->price = $price;
        $this->amount = $amount;
        $this->event_id = $event_id;
        $this->created_at = $created_at;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
        return $this;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }


    public function createTicket($eventid)
    {
        extract($_POST);

        $db = new dataBase();
        $ticket_array = array($free, $regular, $vip, $vvip);
        foreach ($ticket_array as $arr) {
            if (isset($arr['category'])) {
//                $this->setCategory($arr['category'])->setAmount($arr['amount'])->setPrice($arr['price'])->setEventId($eventid);
                $category = $arr['category'];
                $price = $arr['price'];
                $amount = $arr['amount'];

                $sql = "insert into project_eventus.tickets (`category`, `price`, `amount`, `event_id`) values ('$category','$price','$amount','$eventid')";
                $db->setSql($sql)->execQuery();
            }
        }

        if (!$db->getResult()) {
            setMessage('TICKET REGISTRATION FAILED : ' . $db->getConn()->error, 'error');
        } else {
            setMessage('TICKET REGISTERED SUCCESSFULLY', 'success');
        }
        $db->close();

    }

    public function deleteTicket()
    {
        if (isset($_GET['id'])) {
            $db = new dataBase();
            $id = $_GET['id'];
            $result = $db->deleteRecord($id, self::$table);
            if ($result) {
                setMessage('DELETE TICKET SUCCESSFUL', 'success');
            } else {
                setMessage('DELETE TICKET FAILED! :' . $db->getConn()->error, 'error');
            }
            $db->close();
        }
    }

    public function deleteWithEvent()
    {
        if (isset($_GET['id'])) {
            $eventid = $_GET['id'];
            $db = new dataBase();
            $sql = "DELETE FROM " . self::$table . " WHERE `event_id`=" . $eventid;
            $db->setSql($sql);
            $db->execQuery();
            if ($db->getResult()) {
                setMessage('DELETE TICKETs SUCCESSFUL', 'success');
            } else {
                setMessage('DELETE TICKETs FAILED! :' . $db->getConn()->error, 'error');
            }
            $db->close();
        }
    }

    public function updateTicket($id)
    {
        $db = new dataBase();

        if (isset($_POST)) {

            extract($_POST);

            $sql = "UPDATE project_eventus.tickets SET `category`='$category',`amount`='$amount',
                        `price`='$price'
                        WHERE `id`=".$id;
                    $db->setSql($sql)->execQuery();



            $result = $db->getResult();
            if ($result) {
                setMessage('UPDATE TICKET SUCCESSFUL', 'success');
            } else {
                setMessage('UPDATE TICKET FAILED! :' . $db->getConn()->error, 'error');
            }
        }
        $db->close();

    }


    public function displayTickets($id = '')
    {
        $db = new dataBase();
        $sql = "SELECT  `id`, `category` , `price`, `amount`,`event_id`,`created_at`
               FROM project_eventus.tickets";
        if (!empty($id)) {
            $sql .= " WHERE `event_id`=" . $id;
        }


        $db->setSql($sql)->execQuery();

        $tickets = $db->setSql($sql)->getResults(Ticket::class);

//FIELDS
        $db->setTableFields()->disPlayFields();


//ROWS
        echo '<tbody>';
        foreach ($tickets as $ticket) {
            echo '<tr>
                     <td class="id-cell">' . $ticket->getId() . '</td>
                     <td class="name-cell">' . $ticket->getCategory() . '</td>
                     <td>' . $ticket->getPrice() . '</td>
                     <td>' . $ticket->getAmount() . '</td>
                     <td>' . $ticket->getEventId() . '</td>
                     <td>' . $ticket->getCreatedAt() . '</td>
                     <td><a role="button" class="btn btn-outline-danger" href="#deleteModal" data-toggle="modal" aria-controls="deleteModal" class="btn btn-outline-danger">Delete</a>
                     <a role="button" class="btn btn-outline-info" href="edit_ticket.php?id='.$ticket->getId().'">Edit</a>
                     </td>
                 </tr>';
        }
        echo '</tbody></table></div>';
        $db->freeRes();
        $db->close();

    }


}
