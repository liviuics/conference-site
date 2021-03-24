<?php
    include "header.php";
    include "config.php";
    include "connect.php";
?>

            <ul class="menu-bar">
                <li><A href="home.php">Home</a></li>
                <li><A href="callforpapers.php">Call for Papers</a></li>
                <li><A href="committees.php">Committees</a></li>
                <li><A href="news.php">News</a></li>
                <li><A class="active" href="participants.php">Participants</a></li>
                <li><A href="program.php">Program</a> </li>
                <li><A href="contact.php">Contact</a> </li>
                <li  style="float:right"><A href="admin/index.php">Admin Panel</a> </li> 
            </ul>
            <hr>
            <h3 style="text-align:center;">AIDC 2011 - Participants</h3>
            <h3 style="text-align:center;">September 1-3, 2011
                <br>Craiova, ROMANIA</h3>
            <hr>

            <br>
            <div class="participants">
                <h3>AIDC 2011 - CONFERENCE FEES</h3><br>

                <p>The conference fees will be 250 RON (60 EUR). A receipt will be delivered by Society for Computing
                    Technologies.
                </p>

<?php
  $comanda = isset($_REQUEST["comanda"]) ? $_REQUEST["comanda"] : NULL;
  if (isset($comanda)) {
    switch ($comanda) {
      case 'add':
        $nume = $_REQUEST["nume"];
        $email = $_REQUEST["email"];
        $telefon = $_REQUEST["telefon"];
        //Validam datele
        $valid = true;
        if (empty($nume)) {
          $eroareNume = "Numele nu poate fi vid!";
          $valid = false;
        }
        if (empty($email)) {
          $eroareEmail = "Emailul nu poate fi vid!";
          $valid = false;
        }

        if (empty($telefon)) {
          $eroareTelefon = "Introduceti un numar valid!";
          $valid = false;
        }

        if ($valid) {
          $sql = sprintf("INSERT INTO participanti(nume, email, telefon) VALUES ('%s','%s','%s')",
            mysqli_real_escape_string($id_conexiune, $nume),
            mysqli_real_escape_string($id_conexiune, $email),
            mysqli_real_escape_string($id_conexiune, $telefon)
          );

          if (!mysqli_query($id_conexiune, $sql)) {
            die('Error: ' . mysqli_error($id_conexiune));
          }
          $nume = $email = $telefon = "";
          echo "<div class='succes'>Participant inscris cu succes!</div>";
        }

        break;
    }
  }
?>                    
    <?php
            /** Afisarea participantilor din conferinta */
            $query = "SELECT id, nume, email, telefon FROM participanti";
            $result = mysqli_query($id_conexiune, $query);
             print("<b>Participanti:</b>\n");
            if (mysqli_num_rows($result)) {
                print("<ol>\n");
                while ($row = mysqli_fetch_array($result)) {
                $vid = htmlspecialchars($row['id']);
                $vnume = htmlspecialchars($row['nume']);
                $vemail = htmlspecialchars($row['email']);
                $vtelefon = $row['telefon'];
               
                print("<li> Nume: <b>$vnume</b> Email: $vemail Telefon: $vtelefon </li>\n");
                print("\n");
                }
                print("</ol>\n");
            } else {
                print "Nu exista niciun participant!";
            }
       #####  Forma de adaugare PArticipanti
       ?>
    <h2> Inregistrare participanti:</h2>
    <form action="participants.php" method="post">
        <input name="comanda" type="hidden" value="add"/>

        Nume*:  &nbsp; &nbsp; &nbsp;   <input type="text" name="nume" required value="<?php echo htmlspecialchars($nume); ?>" size="30"/>
                <span class="error"><?php echo $eroareNume; ?></span><br/>
        Email*:   &nbsp; &nbsp; &nbsp;      <input type="text" name="email" required value="<?php echo htmlspecialchars($email); ?>" size="30"/>
                <span class="error"><?php echo $eroareEmail; ?></span><br/>
        Telefon*:   &nbsp; &nbsp;   <input type="tel" name="telefon" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" required value="<?php echo htmlspecialchars($telefon); ?>" size="30"/> <span> Format: 0722222222</span> 
                <span class="error"><?php echo $eroareTelefon; ?></span><br/>
        <input type="submit" value="Inregistrare"/>
    </form>

    
    
            </div>
            <hr>


        </div>

<?php
    include "footer.php";
?>