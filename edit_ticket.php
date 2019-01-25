<?php
require_once './initialize.php';
require_once './classes/ticket.php';
require_once 'header_main.php';
getMessage();
if (!isAdmin()) {
    setMessage('INSUFFICIENT PRIVILEGES: ADMIN REQUIRED', 'error');
    header('location:index.php');
}
if (isset($_GET['id'])) {
    $db = new dataBase();
    $id = $_GET['id'];
    $sql = "SELECT  category,price,amount
            from project_eventus.tickets
            where id=" . $id;
    $db->setSql($sql)->execQuery();
    while ($row = mysqli_fetch_object($db->getResult(), "Ticket")) {

        ?>
        <div class="form-wrapper justify-content-center">
            <div class="form-header">EDIT TICKET</div>
            <form id="tickForm" method="post" action="./update_ticket.php?id=<?php echo $id ?>"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category">Category<span>*</span> : can be REGULAR,FREE,VIP,VVIP</label>
                    <input type="text" class="form-control" id="category" placeholder="Enter category" name="category"
                           value="<?php echo $row->getCategory() ?>" required>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="price">price<span>*</span></label>
                    <input type="text" class="form-control" id="price" placeholder="Enter price" name="price"
                           value="<?php echo $row->getPrice() ?>" required>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="amount">amount<span>*</span></label>
                    <input type="text" class="form-control" id="amount" placeholder="Enter amount" name="amount"
                           value="<?php echo $row->getAmount() ?>" required>
                    <span></span>
                </div>
                <button type="submit" name="save" class="btn btn-primary">Save</button>

            </form>
        </div>
        <?php
    }
}
