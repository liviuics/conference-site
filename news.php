<?php
    include "header.php";
    include "config.php";
    include "connect.php";
?>

           <ul class="menu-bar">
                <li><A href="home.php">Home</a></li>
                <li><A href="callforpapers.php">Call for Papers</a></li>
                <li><A href="committees.php">Committees</a></li>
                <li><A class="active" href="news.php">News</a></li>
                <li><A href="participants.php">Participants</a></li>
                <li><A href="program.php">Program</a> </li>
                <li><A href="contact.php">Contact</a> </li>
                <li  style="float:right"><A href="admin/index.php">Admin Panel</a> </li> 
            </ul>
       <hr>

            <h3 style="text-align:center;">AIDC 2011 - Important dates</h3><br>

            <h2 style="text-align:center;">DEADLINES</h2>
            <div class="news">

                <?php
                /** Afisarea anunturilor din conferinta */
                $query = "SELECT id, mesaj, data FROM anunt";
                $result = mysqli_query($id_conexiune, $query);

                if (mysqli_num_rows($result)) {
                    print("<ul>\n");
                    while ($row = mysqli_fetch_array($result)) {
                    $vid = htmlspecialchars($row['id']);
                    $vmesaj = htmlspecialchars($row['mesaj']);
                    $vdata = $row['data'];
                    print("<li>Anunt din data <b>$vdata</b>: $vmesaj</li>\n");
                    }
                    print("</ul>\n");
                } else {
                    print "Nu exista niciun anunt!";
                }
                ?>
            </div>
            <hr>

        </div>
<?php
    include "footer.php";
?>