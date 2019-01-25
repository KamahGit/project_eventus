<?php
require_once 'initialize.php';
require_once './classes/events.php';
require_once './classes/ticket.php';
require_once 'header_main.php';
require_once 'modal_login_reg.php';

getMessage();

?>
<p id="acc" hidden><?php
    if (isLoggedIn()) {
        echo $_SESSION['account_bal'];
    } else {
        echo 'Not Available Login first';
    }
    ?></p>
<div class="event-wrapper">
    <?php
    $db = new dataBase();
    $events = array();
    $tickets = array();
    $sql = "SELECT e.`id` , e.`name`,e.`location`,e.`type`,e.`from`,e.`to`,e.`image`, e.`created_at`
                FROM project_eventus.events e 
                ORDER BY `to` ASC LIMIT 10";

    $db->setSql($sql);
    $db->execQuery();

    while ($row = mysqli_fetch_object($db->getResult(), Events::class)) {
        $events[] = $row;
    }

    $db->freeRes();


    /*TICKETS QUERY*/
    $sql = "SELECT t.`id`, t.`category`, t.`amount`, t.`price` , t.`event_id`
                   FROM project_eventus.tickets t
                   group by id";
    $db->setSql($sql)->execQuery();
    while ($row = mysqli_fetch_object($db->getResult(), Ticket::class)) {
        $tickets[] = $row;
    }
    $db->freeRes();

    /*DISPLAY*/
    foreach ($events as $event) {
        $eventid = $event->getId();
        echo " 
         <div class=\" event-card2\">
                <div CLASS=\"image-div\">
                <a target='_blank' title='Click to View' href='./assets/images/" . $event->getImage() . "'>
                    <img src=\"./assets/images/" . $event->getImage() . "\" alt=\"\">
                </a>
                </div>
                <div class=\"header-div\"><p>" . $event->getName() . "</p></div>
                <div class=\"content-div\">
                    <p>
                        <i class=\"fa fa-map-marker-alt\"></i>
                        Location: " . $event->getLocation() . "
                    </p>
                    <p>
                        <i class=\"fa fa-calendar-alt\"></i>
                        from : <span>" . $event->getFrom() . "</span> <br> <i class=\"fa fa-calendar-alt\"></i> to : <span>" . $event->getTo() . "</span>
                    </p>
                    <div class='tickettable'>
                <table class=\"table table-sm\">
                <thead>
                <tr>
                    <th scope=\"col\">#</th>
                    <th scope=\"col\">Type</th>
                    <th scope=\"col\">Price</th>
                    <th scope=\"col\">Amount Left</th>
                </tr>
                </thead>
                <tbody>";
        foreach ($tickets as $ticket) {
            if ($ticket->getEventId() == $eventid) {
                echo "
                <tr>
                    <th class='id-cell' scope=\"row\">" . $ticket->getId() . "</th>
                    <th class='category' scope=\"row\">" . $ticket->getCategory() . "</th>

                    <td class='price-cell'>" . $ticket->getPrice() . "</td>
                    <td>" . $ticket->getAmount() . "</td>
                </tr>";
            }
        }


        echo "
            </tbody>
            </table>
            </div>
            </div>
                <div class=\"footer-div\">
                    <button class='custbutton bookingBtn' role=\"button\" data-toggle=\"modal\" data-target=\"#displayModal\" aria-controls=\"displayModal\">Book <i class=\"fas fa-arrow-right \"></i></button>
                </div>
        
            </div>";

    }
    ?>
</div>
<div class="modal fade" id="displayModal" tabindex="-1" role="dialog"
     aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"><i class="fa fa-ticket-alt"></i> Buy Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="ticket-modal">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="subbtn" form="booking-form" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<form id="booking-form" method="post" action="booking.php">
</form>
<script>

    //TODO:IMPLEMENT ACCOUNT BAL CHECK BEFORE SUBMIT

    $('#displayModal').on('shown.bs.modal', function (e) {
        let btn = e.relatedTarget;
        let acc = document.querySelector('#acc');
        let card = btn.parentElement.parentElement;
        let table = card.querySelector('.tickettable');
        this.querySelector('.modal-body').innerHTML =
            `<span>Account Balance:</span> <p>${acc.innerHTML}</p> ${table.innerHTML}
 <span>Total :</span> <input type="number" name="total-cost" form="booking-form" id="costcalc"/>
             `;
        $('.modal-body thead tr').append('<th>Booking number</th>');
        $('.modal-body tbody tr').append(
            '<td>\n' +
            '<input type="number"  class="amount" form="booking-form" placeholder="How Many?"/>\n' +
            '<input type="number" class="cost" hidden form="booking-form" />' +
            '<input type="text" class="ticket_id" hidden form="booking-form" />' +
            '</td>');
        let totalcost = document.querySelector('#costcalc');
        let submit = this.querySelector('#subbtn');
        submit.onfocus = findCost();
        let inputs = [...this.querySelectorAll('input')];
        inputs.forEach((input) => {
            let tr = input.parentElement.parentElement;
            let price = tr.querySelector('.price-cell');
            let costin = tr.querySelector('.cost');
            let id = tr.querySelector('.id-cell').innerHTML;
            if (input.className === 'ticket_id') {
                input.name = `Ticket${id}[id]`;
                input.value = id;
            }
            else if (input.className === 'cost') {
                input.name = `Ticket${id}[cost]`;
            } else if (input.className) {
                input.name = `Ticket${id}[amount]`
            }
            else {input.name='totalcost'}
            input.onkeydown = function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    submit.focus();
                }
            };
            input.onchange = function () {

                costin.value = input.value * price.innerHTML;
                findCost();
            };

        });

        function findCost() {
            let total = 0;
            let costs = [...document.querySelectorAll('.cost')];
            costs.forEach(function (cost) {
                total += cost.value;
            });
            totalcost.value = total;
        }

    });
    // $('#displayModal').on('shown.bs.modal', function (e) {
    //     let btn = e.relatedTarget;
    //     let acc = document.querySelector('#acc');
    //     let card = btn.parentElement.parentElement;
    //     let id  =card.querySelector('.id-cell');
    //     // console.log();
    //     bookModal(parseInt(id.innerHTML));
    //     // console.log(id.innerHTML);
    // });


</script>
