<link href="/css/menu.css" rel="stylesheet" type="text/css"/>

<div class="topnav" id="myTopnav">
    <a href="http://projecthanze.com/home" class="active">Home</a>
    <a href="http://projecthanze.com/producten">Producten</a>


	<?php
	if ($_SESSION['account_id'] == true) {

        ?>
        <div class="dropdown">

            <button class="dropbtn">Welkom <?php echo $_SESSION['gebr'] ?>
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <?php
                if ($_SESSION['recht'] == 'A' || $_SESSION['recht'] == 'M') {
                    echo " <a href='http://projecthanze.com/admin/home'>Admin</a>";

                }
                ?>
                <a href='http://projecthanze.com/account'>Account Wijzigen</a>
                <a href='http://projecthanze.com/orders'>Mijn Orders</a>
                <a href="http://projecthanze.com/logout">Logout</a>


            </div>

        </div>


        <?php
	} else {
		?>
        <a href="http://projecthanze.com/signup">Registreren</a>
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
		<?
	}
	?>


    <div id="id01" class="modal">

        <form class="modal-content animate" action="../files/functions/login.inc.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="../images/img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container1">
                <center><label for="mailuid"><b>Username</b></label><br/></center>
                <center><input type="text" placeholder="Enter Username" name="mailuid" required><br/></center>

                <center><label for="pwd"><b>Password</b></label><br/></center>
                <center><input type="password" placeholder="Enter Password" name="pwd" required><br/></center>

                <center><label> <input type="checkbox" checked="checked" name="remember"> Remember me</label></center>

            </div>

            <div class="container">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">
                    Cancel
                </button>
                <button type="submit" name="login-submit" class="button1">Login</button>
            </div>
        </form>
    </div>


</div>


<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


