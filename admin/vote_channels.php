<?php
    require_once 'controllers/db-config.php';
    session_start();
    if (!isset($_SESSION['DUserLoggedIn'])) {
        echo "<script>window.location.href = 'index.php';</script>";
    }


    $session_id = $_SESSION['session_id'];
    $username   = $_SESSION['username'];
    $insertUserQuery = "UPDATE log_hist SET vote_channels = 'Vote Tab Viewed' WHERE session_id = '$session_id' AND username = '$username'";
    mysqli_query($database, $insertUserQuery);



    include 'includes/header.php';
?>

        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light navbar-custom">
            <!-- <a class="navbar-brand" href="#"><img src="logo.jpg" alt="logo" class="navbar-logo" style="border-radius: 100%;"></a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Contestants</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="votes.php">Voters</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="http://bit.ly/Naabeauty" target="_blank">Cast Vote</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Image Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="live_stream.php">Live Stream</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="articles.php">Articles</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="container-fluid main-div">
            <div class="row">
                <!-- side div -->
                <div class="col-md-2 side-div">
                    <li><a href="dashboard.php"><span class="lnr lnr-pie-chart"></span> Dashboard</a></li>
                    <li><a href="contestants.php"><span class="lnr lnr-users"></span> Contestants</a></li>
                    <li class=""><a href="various-channels.php"><span class="lnr lnr-users"></span> Various Channels</a></li>
                    <li class="selected"><a href="vote_channels.php"><span class="lnr lnr-laptop"></span> Vote Channels</a></li>

                    <li><a href="votes.php"><span class="lnr lnr-thumbs-up"></span> Voters</a></li>

                    <li><a href="http://bit.ly/Naabeauty" target="_blank"><span class="lnr lnr-thumbs-up"></span> Cast Vote</a></li>

                   <!--  <li><a href="gallery.php"><span class="lnr lnr-picture"></span> Image Upload</a></li>
                    <li><a class="nav-link" href="live_stream.php"><span class="lnr lnr-camera-video"></span> Live Stream</a></li> -->
                    <hr>
                    <li><a href="logout.php"><span class="lnr lnr-power-switch"></span> Logout</a></li>
                </div>

                <!-- main content div -->
                <div class="container-fluid content-div">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <h5 class="text-center"><b>Contestants details and their voting channels</b></h5><br>
                            <!-- <div class="contestants-summary-res">
                                <div class="data-res-placeholder-div">
                                    <img src="assets/img/spinner.gif" class="img-fluid data-res-placeholder-div-img">
                                    <p class="text-warning"><b>Loading. Please wait...</b></p>

                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-1"></div>

                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Record of contestants and their vote details</strong>
                                 <p class="text-center">Please click the corresponding channel to view all records that contestant</p>
                                <!-- <p class="text-center"> -->
                                    <?php 
                                          //session_start();
                                        if(isset($_SESSION['member_delete']) && !empty($_SESSION['member_delete'])) 
                                        {
                                         echo $_SESSION['member_delete'];
                                         unset($_SESSION['member_delete']);
                                        }else
                                        {
                                            unset($_SESSION['member_delete']);
                                            // session_destroy();
                                        }
                                    ?>
                                <!-- </p> -->
                                <?php if($_SESSION['user_role'] == "Admin"){ ?>
                                <span style="float: right;">
                                    <button class="btn btn-secondary"> <a style="text-decoration: none; color: white;" href="controllers/export_contestant-vote.php"><b>Export Data</b></a></button>
                                </span>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table  table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>RANK</th>
                                            <th>CONTESTANT</th>
                                            <th>VOTES</th>
                                            <th>ALL VOTES</th>
                                            <th>USSD</th>
                                            <th>WEB</th>
                                            <th>SMS</th>
                                            <th>APP</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>RANK</th>
                                            <th>CONTESTANT</th>
                                            <th>VOTES</th>
                                            <th>ALL VOTES</th>
                                            <th>USSD</th>
                                            <th>WEB</th>
                                            <th>SMS</th>
                                            <th>APP</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>

                                         <?php
                                            $i = 1;
                                            // include '/controllers/db-config.php';
                                            // $conn      = new mysqli('localhost','root', '#4kLxMzGurQ7Z~', 'akim');
                                            $stmnt = "SELECT * FROM contestants ORDER BY vote_count DESC";
                                            $get_val = mysqli_query($database,$stmnt);
                                            while ($rows = mysqli_fetch_assoc($get_val)) 
                                            {
                                                // var_dump($rows);
                                            
                                            
                                                //   die();                                                          
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td><?php echo $rows['contestant_name']; ?></td>
                                        <td><?php echo $rows['vote_count'];?></td>
                                        <td> 
                                            <!-- &nbsp; -->
                                            <a href="view_all_channel.php?all_channel_action=<?php echo $rows['contestant_num'];?>&nominee=<?php echo $rows['contestant_name'];?>" id="vorter_details" onclick="return confirm('Do you want to view all records this nominee?');">
                                                <button class="btn btn-danger btn-sm">view all votes
                                                    <i  class="fa fa-asterisk"  title="Click to view all this nominee!">
                                                    <!---->
                                                    </i>
                                                </button>
                                                
                                            </a>
               <!-- trash-o -->         </td>

                                        <td>
                                           <!--  &nbsp; -->
                                            <a href="view_ussd.php?view_ussd_action=<?php echo $rows['contestant_num'];?>&nominee=<?php echo $rows['contestant_name'];?>" id="vorter_details" onclick="return confirm('Do you want to view ussd record for this nominee?');">
                                                <button class="btn btn-secondary btn-sm">ussd votes
                                                    <i  class="fa fa-print"  title="Click to ussd view!">
                                                    <!-- class="fa fa-print"  -->
                                                    </i>
                                                </button>
                                                
                                            </a>
                                        </td>
                                        <td>
                                            <!-- &nbsp; -->
                                            <a href="view_web.php?web_action=<?php echo $rows['contestant_num'];?>&nominee=<?php echo $rows['contestant_name'];?>" id="vorter_details" onclick="return confirm('Do you want to view web record for this nominee?');">
                                                <button class="btn btn-warning btn-sm">web votes
                                                    <i class="fa fa-print"   title="Click to view!">
                                                    <!---->
                                                     </i>
                                                 </button>
                                               
                                            </a>
                                        </td>
                                        <td>
                                            <!-- &nbsp; -->
                                            <a href="view_sms.php?sms_action=<?php echo $rows['contestant_num'];?>&nominee=<?php echo $rows['contestant_name'];?>" id="vorter_details" onclick="return confirm('Do you want to view sms record for this nominee?');">
                                                <button class="btn btn-info btn-sm">sms votes
                                                    <i  class="fa fa-print"  title="Click to view!">
                                                    <!---->
                                                   </i> 
                                               </button>
                                                
                                            </a>
                                        </td>
                                        <td>
                                            &nbsp;
                                            <a href="view_app.php?app_action=<?php echo $rows['contestant_num'];?>&nominee=<?php echo $rows['contestant_name'];?>" id="vorter_details" onclick="return confirm('Do you want to view app record for this nominee?');">
                                                <button class="btn btn-blue btn-sm">app votes
                                                    <i  class="fa fa-print"  title="Click to view!">
                                                    <!---->
                                                    </i>
                                                </button>

                                                
                                            </a>
                                        </td>
                                    </tr>
                                        <?php $i++; }//endforeach ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                    <br><br><br>

                    
                </div>
            </div>
        </div>

        

        

<?php include 'includes/footer.php'; ?>
<script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table').DataTable();
      } );



        // function(){
        //     "colunmDefs":{
        //         "target":[0,3,4,5,6,7],
        //         "orderable":false
        //     }
        //   }
  </script>
<script src="assets/js/controller.js"></script>
<script>
    // getContestantsSummary();
    // showLeaderBoardGraph();
    // showContestantLeaderBoardForWeek();
    // showContestantModalLeaderBoardForWeek();
    // showLeaderBoardModal();
</script>