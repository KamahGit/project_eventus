<?php
require_once './initialize.php';
require_once './header_main.php';
getMessage();
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');}
?>
<div class="form-wrapper">
    <div class="form-header">CREATE EVENT</div>
    <form id="eventForm" method="post" action="./process_create_event.php" enctype="multipart/form-data">
        <div id="name-div" class="form-group">
            <label for="name">Name<span>*</span></label>
            <input type="text" class="form-control" id="name" placeholder="Enter Event Name" name="name"
                   required>
            <span></span>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label for="location">Location<span>*</span></label>
                <input type="text" class="form-control" id="location" placeholder="Enter Event Location"
                       name="location"
                       required>
                <span></span>
            </div>
            <div class="form-group col-sm-6">
                <label for="type">Event Type<span>*</span></label>
                <input type="text" class="form-control" id="type"
                       placeholder="Enter Event Type" name="type" required>
                <span></span>
            </div>
        </div>

        <div class="dropdown-divider"></div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="from">Start Date<span>*</span></label>
                <input type="date" class="form-control" id="from" name="from1"
                       placeholder="Enter Start Date" required>
                <span></span>
            </div>
            <div class="form-group col-md-4">
                <label for="from2">Start Time<span>*</span></label>
                <input type="time" class="form-control" name="from2" id="from2"
                       placeholder="Enter Start Time" required>
                <span></span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="to1">End Date<span>*</span></label>
                <input type="date" class="form-control" id="to1" name="to1"
                       placeholder="Enter End Date" required>
                <span></span>
            </div>
            <div class="form-group col-md-4">
                <label for="to2">End Time<span>*</span></label>
                <input type="time" class="form-control" name="to2" id="to2"
                       placeholder="Enter End Time" required>
                <span></span>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <label ID="label-tick" class="form-row"> TICKETS</label>
        <div class="form-row">
            <div class="form-group col-sm-3">
                <label for="free">free</label><br/>
                <input type="checkbox" id="free" value="free" name="free[category]">
                <div id="free-inputs">
                    <input type="number" class="form-control" id="free-amount" placeholder="How many?"
                           name="free[amount]">
                    <input type="number" class="form-control" id="free-price" placeholder="Cost?" name="free[price]" VALUE="0">
                </div>
            </div>
            <div class="form-group col-sm-3">
                <label for="regular">Regular</label><br/>
                <input type="checkbox" id="regular" value="regular" name="regular[category]">
                <div id="regular-inputs">
                    <input type="number" class="form-control" id="regular-amount" placeholder="How many?"
                           name="regular[amount]">
                    <input type="number" class="form-control" id="regular-price" placeholder="Cost?"
                           name="regular[price]">
                </div>
            </div>
            <div class="form-group col-sm-3">
                <label for="vip">VIP</label><br/>
                <input type="checkbox" id="vip" value="vip" name="vip[category]">
                <div id="vip-inputs">
                    <input type="number" class="form-control" id="vip-amount" placeholder="How many?"
                           name="vip[amount]">
                    <input type="number" class="form-control" id="vip-price" placeholder="Cost?" name="vip[price]">
                </div>
            </div>

            <div class="form-group col-sm-3">
                <label for="vvip">VVIP</label><br/>
                <input type="checkbox" id="vvip" value="vvip" name="vvip[category]">
                <div id="vvip-inputs">
                    <input type="number" class="form-control" id="vvip-amount" placeholder="How many?"
                           name="vvip[amount]">
                    <input type="number" class="form-control" id="vvip-price" placeholder="Cost?" name="vvip[price]">
                </div>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="form-group ">
            <label for="image">Event Photo</label>
            <input type="file" class="form-control" id="image" name="image">

        </div>
        <div class="dropdown-divider"></div>
        <button type="submit" name="save" class="btn btn-primary">Create</button>
    </form>


</div>