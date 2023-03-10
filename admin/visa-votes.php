<?php
    session_start();
    if (!isset($_SESSION['gbmbUserLoggedIn'])) {
        echo "<script>window.location.href = 'index.php';</script>";
    }

    include 'includes/header.php';
?>

        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light navbar-custom">
            <a class="navbar-brand" href="#"><img src="assets/img/logo.jpg" alt="logo" class="navbar-logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contestants.php">Contestants</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">Votes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="visa-votes.php">Visa Votes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://bit.ly/Missghana" target="_blank">Cast Vote</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="gallery.php">Image Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="live_stream.php">Live Stream</a>
                    </li>
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
                    <li class=""><a href="votes.php"><span class="lnr lnr-thumbs-up"></span> MoMo Votes</a></li>
                    <li class="selected"><a href="visa-votes.php"><span class="lnr lnr-thumbs-up"></span> Visa Votes</a></li>
                    <li><a href="http://bit.ly/Missghana" target="_blank"><span class="lnr lnr-thumbs-up"></span> Cast Vote</a></li>

                    <li><a href="gallery.php"><span class="lnr lnr-picture"></span> Image Upload</a></li>
                    <li><a class="nav-link" href="live_stream.php"><span class="lnr lnr-camera-video"></span> Live Stream</a></li>
                    <hr>
                    <li><a href="logout.php"><span class="lnr lnr-power-switch"></span> Logout</a></li>
                </div>

                <!-- main content div -->
                <div class="col-md-10 content-div">
                    <h5 class="text-center">
                        Recent Visa Votes.
                        <?php 
                            if($_SESSION['username'] == "mcc@admin.com") {
                                echo "[<a href='filter-votes.php'><small>Filter and download logs here....</small></a>]";
                            }
                        ?> 
                    </h5>
                    <div class="row">
                       <div class="col-md-2"></div>
                       <div class="col-md-8 recent-voters-res">
                            <div class="data-res-placeholder-div">
                                <img src="assets/img/spinner.gif" class="img-fluid data-res-placeholder-div-img">
                                <p class="text-warning"><b>Loading. Please wait...</b></p>
                            </div>
                       </div>
                       <div class="col-md-2"></div>
                    </div>

                    <hr>
                    <br>

                    <!-- <div class="row">
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Overall Highest Voters</b></h6>
                            <canvas id="votersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                        
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Highest Voters This Week</b></h6>
                            <canvas id="weeklyVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                    </div>
                    <br><hr><br>

                    <div class="row">
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Overall Mobile App Voters Only</b></h6>
                            <canvas id="SMSVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                        
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Overall Mobile Money Voters</b></h6>
                            <canvas id="MOMOVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                    </div> -->



                    <div class="row">
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Overall Highest Voters</b></h6>
                            <canvas id="votersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                        
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Highest Voters This Week</b></h6>
                            <canvas id="weeklyVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                    </div>
                    <br><hr><br>

                    <div class="row">
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Overall Mobile App Voters Only</b></h6>
                            <canvas id="SMSVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                        
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Ussd Voters Only</b></h6>
                            <canvas id="USSDVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                    </div>


                     <br><hr><br>

                    <div class="row">
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Online Voters Only</b></h6>
                            <canvas id="ONLINEVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                        
                        <div class="col-md-6 voters-leaderboard-graph">
                            <h6 class="text-center"><b>Overall Mobile Money Voters</b></h6>
                            <canvas id="MOMOVotersLeaderBoardChart" height="250" width="400"></canvas>
                        </div>
                    </div>




                </div>
            </div>
        </div>

<?php include 'includes/footer.php'; ?>
<script src="assets/js/controller.js"></script>
<script>
    // getRecentVotes();
    getRecentVisaVotes();
    showVotersLeaderBoardGraph();
    showSMSVotersLeaderBoardGraph();
    showMOMOVotersLeaderBoardGraph();
    showUSSDVotersLeaderBoardGraph();
    showONLINEVotersLeaderBoardGraph();
    showWeeklyVotersRankings();




//VOTES PAGE CONTROLLER CONSTANTS.GET_RECENT_VOTES_URL
function getRecentVisaVotes() 
{
    $.get("controllers/get-recent-visavotes.php", function(response) 
    {
        if (response.success) 
        {
            var template = ``;
            var counter = 1;

            if (response.data.length > 0) 
            {

                template += `
                    <table class="table table-sm table-hover data-table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Voter phone no.</th>
                                <th scope="col">Medium</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Voted for</th>
                                <th scope="col">Vote date</th>
                            </tr>
                        </thead>
                        <tbody>
                `;
                response.data.forEach( function(item) 
                {

                    template += `
                        <tr>
                            <th scope="row">${counter}</th>
                            <td>${item.number}</td>
                            <td>${item.channel}</td>
                            <td>${item.amount}</td>
                            <td>${item.nominee_name}</td>
                            <td>${item.when}</td>
                        </tr>
                    `;

                    counter += 1;
                });

                template += `
                        </tbody>
                    </table>
                `;
            } else {
                template += `
                        <div class="jumbotron">
                            <h3 class='text-center'>No Recent vote history</h3>
                        </div>
                `; 
            }

        } else {
            template += `
                    hello
            `; 
        }

        $('.recent-voters-res').html(template);
        $('.data-table').DataTable();
    })
}
</script>