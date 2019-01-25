<?php
/**
 * Created by PhpStorm.
 * User: Bruce
 * Date: 1/20/2019
 * Time: 9:55 PM
 */
require_once 'db.php';

class Events
{
    private $id;
    private $name;
    private $location;
    private $type;
    private $from;
    private $to;
    private $image;
    private $created_by;
    private $created_at;
    private static $table = 'events';

    /**
     * Events constructor.
     * @param $id
     * @param $name
     * @param $location
     * @param $type
     * @param $from
     * @param $to
     * @param $image
     * @param $created_by
     * @param $created_at
     */
    public function customConstruct($id, $name, $location, $type, $from, $to, $image, $created_by, $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->type = $type;
        $this->from = $from;
        $this->to = $to;
        $this->image = $image;
        $this->created_by = $created_by;
        $this->created_at = $created_at;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getCreatedBy()
    {
        return $this->created_by;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
        return $this;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }


    public function createEvent()
    {
        extract($_POST);
        $from = "$from1 $from2";
        $to = "$to1 $to2";
        $trail = saveImage('events', 'image');
        $db = new dataBase();
        $admin = $_SESSION['id'];
        $sql = "INSERT INTO project_eventus.events (`name`, `location`, `type`, `from`, `to`, `image`, `admin_id`) 
                    VALUES ('$name','$location','$type','$from','$to','$trail','$admin')";
        $db->setSql($sql);
        $db->execQuery();
        $eventid = $db->getConn()->insert_id;
        (new Ticket())->createTicket($eventid);

        if (!$db->getResult()) {
            setMessage('EVENT REGISTRATION FAILED : ' . $db->getConn()->error, 'error');
        } else {
            setMessage('EVENT REGISTERED SUCCESSFULLY', 'success');
        }
        $db->close();

    }

    public function deleteEvent()
    {
        if (isset($_GET['id'])) {
            $db = new dataBase();
            $id = $_GET['id'];
            $result = $db->deleteRecord($id, self::$table);
            if ($result) {
                setMessage('DELETE EVENT SUCCESSFUL', 'success');
            } else {
                setMessage('DELETE EVENT FAILED!', 'error');
            }
            $db->close();
        }

    }

    public function updateEvent($id)
    {

        if (isset($_POST)) {
            extract($_POST);
            $db= new dataBase();

            $from = "$from1 $from2";
            $to = "$to1 $to2";
            $trail = saveImage('events', 'image');

            $sql = "UPDATE " . self::$table . " SET `name`='$name',`location`='$location',`type`='$type',`image`='$trail',`from`='$from', `to`='$to',`admin_id`='$admin'
                    WHERE `id`=".$id;
             $db->setSql($sql)->execQuery();
            if ($db->getResult()) {
                setMessage('UPDATE EVENT SUCCESSFUL', 'success');
            } else {
                setMessage('UPDATE EVENT FAILED!', 'error');
            }
            $db->close();
        }

    }


    public function displayEvent($id = '')
    {
        $db = new dataBase();


        $sql = "SELECT e.`id`, e.`name`,e.`location`,e.`type`,e.`from`,e.`to`,e.`image`,concat_ws(' ',user.`fname`,user.`lname`) 
                as `created_by`, e.`created_at`
                FROM project_eventus.events e 
                INNER JOIN project_eventus.user on e.`admin_id` = user.`id`";
        if (!empty($id)) {
            $sql .= " WHERE user.`id`=" . $id;
        }
        $events = $db->setSql($sql)->getResults(__CLASS__);

        //FIELDS
        $db->setTableFields()->disPlayFields();


        //ROWS
        echo '<tbody>';
        foreach ($events as $event) {
            echo '<tr>
                     <td>' . $event->getId() . '</td>
                     <td>' . $event->getName() . '</td>
                     <td>' . $event->getLocation() . '</td>
                     <td>' . $event->getType() . '</td>
                     <td>' . $event->getFrom() . '</td>
                     <td>' . $event->getTo() . '</td>
                     <td class="imgdsp">' . displayImage($event->getImage()) . '</td>
                     <td>' . $event->getCreatedBy() . '</td>
                     <td>' . $event->getCreatedAt() . '</td>
                     <td><a type="button" href=./delete_event.php?id=' . $event->getId() . ' class="btn btn-outline-danger">Delete</a>
                         <button type="button" class="btn btn-outline-info">Edit</button>
                         <button type="button" class="btn btn-outline-info">Tickets</button>
                     </td>
                 </tr>';
        }
        echo '</tbody></table></div>';
        $db->freeRes();
        $db->close();
    }


}
