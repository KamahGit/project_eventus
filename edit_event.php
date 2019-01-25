<?php
require_once './initialize.php';
require_once './classes/events.php';

require_once 'header_main.php';
getMessage();
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');
}
if (isset($_GET['id'])) {
    $db = new dataBase();
    $ticket = array();
    $id = $_GET['id'];
    $sql = "SELECT id, name, location, type, `from`, `to`, image, admin_id 
            from project_eventus.events
            where id=" . $id;
    $db->setSql($sql)->execQuery();
    while ($row = mysqli_fetch_object($db->getResult(), "Events")) {
        $fromarray = explode(" ", $row->getFrom());
        $toarray = explode(" ", $row->getTo());
$event = $row;
    }
//    var_dump($event);
    $db->freeRes();



}
?>
<div class="form-wrapper">
    <div class="form-header">EDIT EVENT</div>
    <form id="eventForm" method="post" action="./update_event.php?id=<?php echo $id?>" enctype="multipart/form-data">
        <div id="name-div" class="form-group">
            <label for="name">Name<span>*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Enter Event Name" name="name"
                   value="<?php echo $event->getName() ?>" required>
            <span></span>
        </div>
        <div id="admin-div" class="form-group">
            <label for="admin">Admin<span>*</span></label>
            <input type="number" class="form-control" id="admin" placeholder="Enter Admin ID" name="admin"
                   value="<?php echo $event->admin_id ?>" required>
            <span></span>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="location">Location<span>*</span></label>
                <input type="text" class="form-control" id="location" placeholder="Enter Event Location"
                       name="location"
                       value="<?php echo $event->getLocation() ?>" required>
                <span></span>
            </div>
            <div class="form-group col-sm-6">
                <label for="type">Event Type<span>*</span></label>
                <input type="text" class="form-control" id="type"
                       placeholder="Enter Event Type" name="type" value="<?php echo $event->getType() ?>" required>
                <span></span>
            </div>
        </div>

        <div class="dropdown-divider"></div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="from">Start Date<span>*</span></label>
                <input type="date" class="form-control" id="from" name="from1"
                       placeholder="Enter Start Date" value="<?php echo $fromarray[0] ?>" required>
                <span></span>
            </div>
            <div class="form-group col-md-4">
                <label for="from2">Start Time<span>*</span></label>
                <input type="time" class="form-control" name="from2" id="from2"
                       placeholder="Enter Start Time" value="<?php echo $fromarray[1] ?>" required>
                <span></span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="to1">End Date<span>*</span></label>
                <input type="date" class="form-control" id="to1" name="to1"
                       placeholder="Enter End Date" value="<?php echo $toarray[0] ?>" required>
                <span></span>
            </div>
            <div class="form-group col-md-4">
                <label for="to2">End Time<span>*</span></label>
                <input type="time" class="form-control" name="to2" id="to2"
                       placeholder="Enter End Time" value="<?php echo $toarray[1] ?>" required>
                <span></span>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <label ID="label-tick" class="form-row"> TICKETS</label>

        <div class="dropdown-divider"></div>
        <div class="form-group ">
            <label for="image">Event Photo <a href="./assets/images/<?php echo $event->getImage()?>">Current Image(don't edit if you won't change )</a></label>
            <input type="file" class="form-control" id="image" name="image">

        </div>
        <div class="dropdown-divider"></div>
        <button type="submit" name="save" class="btn btn-primary">Create</button>
    </form>


</div>