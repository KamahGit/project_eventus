<?php
require_once './initialize.php';
require_once './header_main.php';


getMessage();
if (!isLoggedIn()) {
    setMessage('LOGIN FIRST TO VIEW YOUR BOOKINGS', 'error');
    header('location:index.php');
}else{
    $id =$_SESSION['id'];
}
$db = new dataBase();


$sql = "SELECT e.`name` as `event name`, e.`image`, e.`from`, e.`to`, `tickets`.`category`, `tickets`.`price`, `tickets_purchased`.`amount`, `tickets_purchased`.`cost`
        FROM `project_eventus`.`events` e
        inner join `project_eventus`.`tickets` on `tickets`.`event_id`= e.`id`
        inner join `project_eventus`.`tickets_purchased` on `tickets_purchased`.`ticket_id`=`tickets`.`id`";
if (!empty($id)) {
    $sql .= " WHERE `tickets_purchased`.`user_id`=" . $id;
}
$events = $db->setSql($sql)->execQuery();

//FIELDS
$db->setTableFields()->disPlayFields();


//ROWS
echo '<tbody>';
while ($row = mysqli_fetch_assoc($db->getResult())) {
    echo '<tr>
                     <td>' . $row["event name"] . '</td>
                     <td>' . displayImage($row["image"]) . '</td>
                     <td>' . $row["from"] . '</td>
                     <td>' . $row["to"] . '</td>
                     <td>' . $row["category"] . '</td>
                     <td>' . $row["price"] . '</td>
                     <td>' . $row["amount"] . '</td>
                     <td>' . $row["cost"] . '</td>
                    
                 </tr>';
}
echo '</tbody></table></div>';
$db->freeRes();
$db->close();
?>


<script>
    window.onload = function () {
        $(document).ready(function () {
            //inialize datatable
            $('#myTable').DataTable();

            //hide alert
            $(document).on('click', '.close', function () {
                $('.alert').hide();
            })
        });

    };


</script>