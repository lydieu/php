<?php
// echo phpinfo();

if (isset($_GET['search'])) {
    try {
        require_once 'sybase_connect.php';
        
        $searchterm = $_GET['searchterm'];
        $sql = "SELECT ins_no, misc8, source, possible_outcome
                FROM sbnmaster..ma_installations
                inner join ATOMICA..UK_RPI_FLAG on misc8 = code
                WHERE ins_no = '$searchterm'";

        $result = odbc_exec($conn,$sql);
        if (!$result) {
            $error = 'No results found';
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SBN: RPI</title>
        <link href="styles/styles.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <h1>SBN: RPI</h1>
        <form method="get" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p>
                <label for="searchterm">Installation Number:</label>
                <input type="search" name="searchterm" id="searchterm">
                <input id='btn' type="submit" name="search" value="Go">
            </p>

        </form>

        <?php 

        if (isset($error)) {
            echo "<p>$error</p>";
        } 
        elseif (isset($result)) {

            while (odbc_fetch_row($result)) { 
                echo '<div class="Table">';
                echo '   <div class="Title">';
                echo '         <p> Ins no: '.odbc_result($result,'ins_no').'</p>';
                echo '   </div>';

                echo '   <div class="Heading">';
                echo '      <div class="Cell">';
                echo '         <p>Source</p>';
                echo '      </div>';
                echo '      <div class="Cell">';
                echo '         <p>Possible outcome</p>';
                echo '      </div>';
                echo '   </div>';

                echo '   <div class="Row">';
                echo '      <div class="Cell">';
                echo '         <p>'.odbc_result($result,'source').'</p>';
                echo '      </div>';
                echo '      <div class="Outcome">';
                echo '         <p>'.odbc_result($result,'possible_outcome').'</p>';
                echo '      </div>';
                echo '   </div>';
                echo '</div>';
            }
            
        } 
        else {
            echo "<p>No results found</p>";
        }
        
        if (isset($result)) {
            odbc_close($conn);
        }

        ?>
    </body>

</html>