<?php
session_start();
require_once "../config.php";
include  "../connect.php";
include  "../header.php";
include  "util.php";
?>
 <link href="../css/style.css" rel="stylesheet" type="text/css" />

 <ul class="menu-bar">
                <li><A href="../home.php">Home</a></li>
                <li><A href="../callforpapers.php">Call for Papers</a></li>
                <li><A href="../committees.php">Committees</a></li>
                <li><A href="../news.php">News</a></li>
                <li><A href="../participants.php">Participants</a></li>
                <li><A href="../program.php">Program</a> </li>
                <li><A href="../contact.php">Contact</a> </li>
                <li  style="float:right"><A class="active" href="index.php">Admin Panel</a> </li> 
            </ul>
       <hr>
       <h1 align="center">Administrare Conferinta</h1>
<?php
$comanda = isset($_REQUEST["comanda"]) ? $_REQUEST["comanda"] : NULL;
if (isset($comanda)) {
  switch ($comanda) {
    case 'login':
      $nume = $_REQUEST["nume"];
      $parola =  $_REQUEST["parola"];
      if (!doLogin($nume, $parola)) {
        echo "<div class='error'>Autentificare esuata!</div>";
      }
      break;

    case 'logout':
      doLogout();
      break;
  }
}

if (!isLogged()) {
  include "login-form.php";
} else {
  printf('<div align="right">Welcome <b>%s</b> | <a href="index.php?comanda=logout">Logout</a></div>', getLoggedUser());
  /* Userul e autentificat */
  switch ($comanda) {
    case 'deleteAnunt':
      $id = $_REQUEST["id"];
      if (deleteAnunt($id)) {
        echo "<div class='succes'>Intrarea cu id-ul $id din anunturi a fost stearsa cu succes.</div>";
      } else {
        echo "<div class='error'>Stergere esuata.</div>";
      }
      break;
    case 'deleteParticipant':
      $id = $_REQUEST["id"];
      if (deleteParticipant($id)) {
        echo "<div class='succes'>Intrarea cu id-ul $id din participanti a fost stearsa cu succes.</div>";
      } else {
        echo "<div class='error'>Stergere esuata.</div>";
      }
      break;
      case 'add':
        $data = $_REQUEST["data"];
        $mesaj = $_REQUEST["mesaj"];
        //Validam datele
        $valid = true;
        if (empty($mesaj)) {
          $eroareMesaj = "Mesajul nu poate fi vid!";
          $valid = false;
        }
        if (empty($data)) {
          $eroareData = "Data nu poate fi vida!";
          $valid = false;
        }

        if ($valid) {
          $sql = sprintf("INSERT INTO anunt(data, mesaj) VALUES ('%s','%s')",
            mysqli_real_escape_string($id_conexiune, $data),
            mysqli_real_escape_string($id_conexiune, $mesaj),
          );

          if (!mysqli_query($id_conexiune, $sql)) {
            die('Error: ' . mysqli_error($id_conexiune));
          }
          $mesaj = $data = "";
          echo "<div class='succes'>Anunt adaugat cu succes!</div>";
          header("Location:   index.php");
        }

        break;
    
      case 'editAnunt':
     
        $id = $_REQUEST["id"];
        $valid = true;

        if ($valid) {
        $sql = sprintf("SELECT * FROM anunt WHERE id=$id"); 
        $result = mysqli_query($id_conexiune, $sql);
        if ($row = mysqli_fetch_array($result)) {
          $data = $row['data'];
          $mesaj = $row['mesaj'];
          $data=mysqli_real_escape_string($id_conexiune,$data);
          $mesaj=mysqli_real_escape_string($id_conexiune,$mesaj);
        ?>
          <!-- Forma de editare (begin) -->
        <div class="editAnunt">
          <h3>Editare anunt</h3>
          <form action="index.php" method="post">
            <input name="comanda" type="hidden" value="updateAnunt" />
            <input name="id" type="hidden" value="<?php echo $id;?>" />
            
            Data: &nbsp;&nbsp;<input type="date" name="data" required value="<?php echo $data; ?>"/><br>
            Mesaj: <input type="text" name="mesaj" required value="<?php echo $mesaj;?>"/>
          <br>
            <input type="submit" value="Update"/>
          <br> <br>
          </form>
        </div>
          <!-- Forma de editare (end) -->
        <?php           
        } else {
          echo "<font color='red'>Intrarea cu id-ul $id nu exista!</font><br/>";
        }
        break; 
      }
    

      case 'updateAnunt':
        $id =  $_REQUEST["id"];
        $data = $_REQUEST["data"];
        $mesaj =  $_REQUEST["mesaj"];
        $data=mysqli_real_escape_string($id_conexiune,$data);
        $mesaj=mysqli_real_escape_string($id_conexiune,$mesaj);
 
        $sql = sprintf("UPDATE anunt SET data='$data', mesaj='$mesaj' WHERE id='$id'"); 
        if (!mysqli_query($id_conexiune, $sql)) {
          die('Error: ' . mysqli_error($id_conexiune));  
        } else {
          echo "<font color='red'>Intrarea cu id-ul $id a fost actualizata cu succes!</font><br/>";
        }
        break;
      
    
      case 'editParticipant':
     
        $id = $_REQUEST["id"];
        $valid = true;

        if ($valid) {
        $sql = sprintf("SELECT * FROM participanti WHERE id=$id"); 
        $result = mysqli_query($id_conexiune, $sql);
        if ($row = mysqli_fetch_array($result)) {
          $nume = $row['nume'];
          $email = $row['email'];
          $telefon = $row['telefon'];
          $nume=mysqli_real_escape_string($id_conexiune,$nume);
          $email=mysqli_real_escape_string($id_conexiune,$email);
          $telefon=mysqli_real_escape_string($id_conexiune,$telefon);
        ?>
          <!-- Forma de editare (begin) -->
        <div class="editParticipant">
          <h3>Editare participant</h3>
          <form action="index.php" method="post">
            <input name="comanda" type="hidden" value="updateParticipant" />
            <input name="id" type="hidden" value="<?php echo $id;?>" />
            
             Nume: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nume" required value="<?php echo $nume;  ?>" size="30" /> 
            <br> Email:   &nbsp; &nbsp; &nbsp;&nbsp;      <input type="text" name="email" required value="<?php echo htmlspecialchars($email); ?>" size="30"/>
                <span class="error"><?php echo $eroareEmail; ?></span><br/>
             Telefon:   &nbsp; &nbsp;   <input type="tel" name="telefon" pattern="[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" required value="<?php echo htmlspecialchars($telefon); ?>" size="30"/> <span> Format: 0722222222</span> 
                <span class="error"><?php echo $eroareTelefon; ?></span><br/>
            <input type="submit" value="Update"/>
                 <br><br>
          </form>
        </div>
          <!-- Forma de editare (end) -->
        <?php           
        } else {
          echo "<font color='red'>Intrarea cu id-ul $id nu exista!</font><br/>";
        }
        break; 
      }
    

      case 'updateParticipant':
        $id =  $_REQUEST["id"];
        $nume = $_REQUEST["nume"];
        $email =  $_REQUEST["email"];
        $telefon =  $_REQUEST["telefon"];
        $nume=mysqli_real_escape_string($id_conexiune,$nume);
        $email=mysqli_real_escape_string($id_conexiune,$email);
        $telefon=mysqli_real_escape_string($id_conexiune,$telefon);
        $sql = sprintf("UPDATE participanti SET nume='$nume', email='$email', telefon='$telefon' WHERE id='$id'"); 
        if (!mysqli_query($id_conexiune, $sql)) {
          die('Error: ' . mysqli_error($id_conexiune));  
        } else {
          echo "<font color='red'>Intrarea cu id-ul $id a fost actualizata cu succes!</font><br/>";
        }
        break;
      }    
    
    



  listAnunt();
?>
<div class="anunt">
  <h3> Adaugare anunt:</h3>
    <form action="index.php" method="post">
        <input name="comanda" type="hidden" value="add"/>

        Anunt <br>
        Mesaj:  &nbsp; &nbsp; &nbsp;   <input type="text" name="mesaj" required value="<?php echo htmlspecialchars($mesaj); ?>" size="32"/>
                <span class="error"><?php echo $eroareAnunt; ?></span><br/>
        Data:   &nbsp; &nbsp; &nbsp; &nbsp;   <input type="date" name="data" required value="<?php echo htmlspecialchars($data); ?>" size="32"/> 
                <span class="error"><?php echo $eroareAnunt; ?></span><br/>
        <input type="submit" value="Adaugare"/>
    </form>
  </div>
<?php
  listParticipanti();

?>
<div class="anunt">
<h3> Adaugare participanti:</h3>
    <form action="../participants.php" method="post">
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
<?php
}
include     "../footer.php";
?>
