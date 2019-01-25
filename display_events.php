<?php
require_once './initialize.php';
require_once './classes/events.php';
require_once './classes/ticket.php';
require_once './header_main.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];
}else{$id = '';}
getMessage();
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');}
$db = new dataBase();


$sql = "SELECT e.`id`, e.`name`,e.`location`,e.`type`,e.`from`,e.`to`,e.`image`,concat_ws(' ',user.`fname`,user.`lname`) 
                as `created_by`, e.`created_at`
                FROM project_eventus.events e 
                INNER JOIN project_eventus.user on e.`admin_id` = user.`id`";
if (!empty($id)) {
    $sql .= " WHERE user.`id`=" . $id;
}
$events = $db->setSql($sql)->getResults('Events');

//FIELDS
$db->setTableFields()->disPlayFields();


//ROWS
echo '<tbody>';
foreach ($events as $event) {
    echo '<tr>
                     <td class="id-cell">' . $event->getId() . '</td>
                     <td class="name-cell">' . $event->getName() . '</td>
                     <td>' . $event->getLocation() . '</td>
                     <td>' . $event->getType() . '</td>
                     <td>' . $event->getFrom() . '</td>
                     <td>' . $event->getTo() . '</td>
                     <td>' . displayImage($event->getImage()) . '</td>
                     <td>' . $event->getCreatedBy() . '</td>
                     <td>' . $event->getCreatedAt() . '</td>
                     <td><a role="button" class="btn btn-outline-danger" href="#deleteModal" data-toggle="modal" aria-controls="deleteModal" class="btn btn-outline-danger">Delete</a>
                         <a role="button" href="edit_event.php?id='.$event->getId().'" class="btn btn-outline-info" >Edit</a>
                         <a role="button" href="display_tickets.php?id='.$event->getId().'" class="btn btn-outline-info">Tickets</a>
                     </td>
                 </tr>';
}
echo '</tbody></table></div>';
$db->freeRes();
$db->close();
?>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
     aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><i class="fa fa-trash-alt"></i> Delete Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ticket-modal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>


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
    $('#deleteModal').on('shown.bs.modal', function (e) {
        let btn = e.relatedTarget;
        let row = btn.parentElement.parentElement;
        let id = row.firstElementChild.innerText;
        let name = row.querySelector('.name-cell').innerText;
        console.log(row, name, id);
        this.querySelector('.modal-body').innerText = `ARE YOU SURE TO DELETE ${name}?`;
        this.querySelector('.btn-danger').onclick = function () {
            window.location = `./delete_event.php?id=${id}`;
        };
    });


</script>