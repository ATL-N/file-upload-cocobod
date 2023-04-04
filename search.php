
<?php
include("login.php");
if (empty($_SESSION['username'])){
	header("Location:login_page1.php");
	exit;
}
//database connecttion here

include("conn.php");

// Handle the search/filter functionality
global $result;
global $total_pages;
$start = "";
$search ="";

// $total_results = mysqli_num_rows($result);


$pi = "1";
$results_per_page = 10;



?>

<!DOCTYPE html>
<html>
<head>
	<title>View Files</title>
    <link rel="stylesheet" href="search1.css">
    <link rel="icon" href="resources/logo.jpg" type="image/x-icon">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>
<body>
<div class="form_container">
    <div class="header_div">
      <div class="h1_div">
      <h1>Files</h1>
      </div>
      <div class="home_div">
      <button class="button" onclick="document.location='uploadSelector.php'">UPLOAD FILE</button>
    
      </div>

      <div class="home_div">
      <button class="button" onclick="document.location='index.php'">HOME</button>
     
      </div>

     

    </div>

<!-- Add the search/filter form to your HTML -->

<div class="form_div">
  <div class="select_folder_div">
      <button class="button" id="button_select" onclick="document.location='search_selector.php'">change folder</button>
    
  </div>

  <div>
    <form method="post" action="">
      <div class="hidden"><input type='text' class ='hidden' name='folder_name' id='folder_name' value='<?php echo validate($_GET["folder_name"]); ;?>'></div>

      <div class="search-label"> <label for="search">Search files:</label></div>
      <div > <input type="text" class="search-box" name="search" id="search" placeholder="file number or description">
            <div class="tooltip"> <span class="tooltiptext">Search using file no.</span></div>
      </div>
        
      <div class="search-button"><button type="submit" id= "searchbtn" value="searchbtn" name="searchbtn">Search</button></div>
    </form>
  </div>
</div>


<!-- Display the list of files in a table -->
<div class="table_div">
<div class="table_div_center">

<table class="file_table_div" id="file_table">
  <thead>
    <tr>
      <th>File Name</th>
      <th>Folder Name</th>
      <!-- <th>Folder Number</th> -->
      <th>File number</th>
      <th>Description</th>
      <th style="width:70px"></th>
      <th style="width:70px"></th>
    </tr>
  </thead>
  <tbody>

 <?php
                
                function validate($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
                global $folder_name;
                $folder_name = "";
                $folder_name = validate($_GET["folder_name"]);
                
                if (isset($_GET['page'])) {
                  $current_page = $_GET['page'];
                } else {
                  $current_page = 1;
                }

                if(empty($folder_name)) {
                    
                  echo "cant display all results";
                  
                  //   return $result;
                }

                  else {
                    global $result;
                    global $start_index;
  
                  //   $search = 0;
  
  
                    $start_index = ($current_page - 1) * $results_per_page;
  
                    $total = $conn->query("SELECT * FROM files WHERE folder_name = '$folder_name'and deleted = 'True' ORDER BY id DESC LIMIT 1000");
                    $total_results = mysqli_num_rows($total);                      
                    // echo($total_results);
  
                    // calculate total number of pages
                    $total_pages = ceil($total_results / $results_per_page);
  
  
                    $sql = "SELECT * FROM files WHERE folder_name = '$folder_name' and deleted = 'True' ORDER BY id DESC LIMIT $start_index, $results_per_page ";
                    $result = mysqli_query($conn, $sql);
                    // header("Location: search2.php?search=$search1");
     



                    // if(empty($_POST["searchbtn"])) {
                    //     // echo "empty search";
                    
                    //   }
      
                      if(isset($_POST["searchbtn"])) {
                            global $result;
                            global $start_index;
                            // echo("sear");
                            $search = validate($_POST['search']);
                            // echo $search;
                            if (!empty($search)){
      
                            $start_index = ($current_page - 1) * $results_per_page;
      
                            // get total number of rows in table
                            $total = $conn->query("SELECT * FROM files WHERE folder_name = '$folder_name' and folder_number LIKE '%$search%' and deleted = 'True' OR description LIKE '%$search%' OR reference_number LIKE '%$search%' OR unique_reference LIKE '%$search%' ORDER BY id DESC");
                            $total_results = mysqli_num_rows($total);                      
      
                            // calculate total number of pages
                            $total_pages = ceil($total_results / $results_per_page);
      
      
                            // $search = isset ($_POST['search']);
                            $sql = "SELECT * FROM files WHERE folder_name = '$folder_name' and description LIKE '%$search%' and deleted = 'True' OR reference_number LIKE '%$search%' OR unique_reference LIKE '%$search%'  LIMIT $start_index, $results_per_page ";
                            $result = mysqli_query($conn, $sql);
                            // header("Location: view_files.php?folder_name=$folder_name&search=$search");
                            
                            
                        } 
                        else{
                          echo "no search value";
                        }
                      }

                } 
                

                if (!empty($result) && mysqli_num_rows($result)>0){

                while ($row = mysqli_fetch_assoc($result)) { ?>
                    
                    <tr>
                      <td class='hidden'> <?php echo $row['id'] ;?></td>

                      <td> <?php echo $row['filename'] ;?></td>
                      
                      <td> <?php echo $row['folder_name'] ;?></td>
                      <td> <?php echo $row['unique_reference'] ;?></td>
                      <td> <?php echo $row['description']  ;?> </td>
                      <td>  <a href='download.php?file=<?php echo $row['filename'];?>' onclick="return confirm('DOWNLOAD  <?php echo $row['filename'] ;?>?')"> DOWNLOAD </a></td>
                      <td>  <a href='delete.php?folder_name=<?php echo $row['folder_name'] ;?>&table_id=<?php echo $row['id'];?>' onclick="return confirm('DELETING  <?php echo $row['filename'] ;?>?')"> DELETE </a></td>

                    </tr>
                    
                    <?php }
                }
                

                else {
                    ?>
                    <tr>
                    <!-- <td><?php echo "no such file found in $folder_name folder";?></td> -->
                    <td><?php echo "empty";?></td>
                    <td><?php echo "empty";?></td>
                    <td><?php echo "empty";?></td>
                    <td><?php echo "empty";?></td>
                    </tr>
                  
                    <?php } ?>
                  
  </tbody>
</table>


</div>
<div class="pagination">

<!-- pagination -->

<?php
  
          

        if (isset($_GET['page'])) {
          $current_page = $_GET['page'];
        } else {
          $current_page = 1;
        }
      
        // display pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
          if ($i == $current_page) {
            echo $i . ' ';
          } else {
            echo '<a class="button2" href="?folder_name='.$folder_name.'&page=' . $i . '" >' . $i . '</a> ';
          }
        }

        // close database connection
        $conn->close();
    ?>

               
</div>

</div>
</div>
<script src="./main.js">
  function conMessage() {

// alert("button was clicked");
if (confirm("Do you want to delete the file")){
    window.location.href = "delete.php?folder_name=" + folder_name;
    console.log("loaded");
    }




}
</script>
  </body>
  </html>
