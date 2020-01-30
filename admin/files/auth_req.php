<?php

if ($_SESSION['logged_in'] == true && ($_SESSION['recht'] == "A" || $_SESSION["recht"] == "M")) {
    if (isset($_GET['nid'])) {
        $nid = $_GET['nid'];
        $qu = "UPDATE requests SET status='" . 'afgewezen' . "' WHERE id= '" . $nid . "' ";
        $re = mysqli_query($conn, $qu);

        ?>
        <script>
            history.back();
        </script>
        <?
    }
    if (isset($_GET['qid'])) {
        $qid = $_GET['qid'];
        $qu = "UPDATE requests SET status='" . 'ja' . "' WHERE id= '" . $qid . "' ";
        $re = mysqli_query($conn, $qu);

        ?>
        <script>
            history.back();
        </script>
        <?
    }
    if (isset($_GET['yid'])) {
        $yid = $_GET['yid'];
        $qu = "UPDATE orderregels SET status='" . 'toegewezen' . "' WHERE id= '" . $yid . "' ";
        $re = mysqli_query($conn, $qu);
        ?>
        <script>
            history.back();
        </script>
        <?
    }
    if (isset($_GET['bid'])) {
        $bid = $_GET['bid'];
        $qu = "UPDATE orderregels SET status='" . 'betaald' . "' WHERE id= '" . $bid . "' ";
        $re = mysqli_query($conn, $qu);
        ?>
        <script>
            history.back();
        </script>
        <?
    }
    if (isset($_GET['aid'])) {
        $aid = $_GET['aid'];
        $qu = "UPDATE orderregels SET status='" . 'aanwezig' . "' WHERE id= '" . $aid . "' ";
        $re = mysqli_query($conn, $qu);
        ?>
        <script>
            history.back();
        </script>
        <?
    }

} else {
    header("Location: http://projecthanze.com/admin/home");
}
