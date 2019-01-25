<?php
require_once 'initialize.php';
require_once './classes/ticket.php';
require_once 'header_main.php';
getMessage();
if(isset($_GET['id'])){
    $eventid = $_GET['id'];
}
(new Ticket())->displayTickets($eventid);
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
            window.location = `./delete_ticket.php?id=${id}`;
        };
    });


</script>
