<?php
session_start();
include("dbcon.php");

$orgName = $_GET['orgName'];
$orgAddress = $_GET['orgAddress'];
$appealID = $_GET['appealID'];

$_SESSION['sesOrgName'] = $orgName;
$_SESSION['sesOrgAdd'] = $orgAddress;
$_SESSION['sesAppealID'] = $appealID;

$query = "SELECT * FROM APPEAL WHERE appealID = '$appealID'";
$appeal = $connection->query($query);

if($appeal -> num_rows > 0)
{
while($appeal_data = $appeal -> fetch_assoc()){
    $from_date = $appeal_data['fromDate'];
    $to_date = $appeal_data['toDate'];
    $description = $appeal_data['description'];
    $outcome = $appeal_data['outcome'];
    }
}
?>
<title>Appeal Details</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="nav.css">
<link rel="stylesheet" href="currAppOrg.css">
<link rel="stylesheet" href="modal.css">

<div class="page">
  <nav class="page__menu menu">
    <ul class="menu__list r-list">
      <li class="menu__group"><a href="betterLogin.php" class="menu__link r-link text-underlined">Sign In</a></li>
      <li class="menu__group"><a href="currentAppeals.php" class="menu__link r-link text-underlined">Current Appeals</a></li>
      <li class="menu__group"><a href="pastAppeals.php" class="menu__link r-link text-underlined">Past Appeals</a></li>
    </ul>
  </nav>
</div>

<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-12 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-lg-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="icondonate.png" class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600"><?php echo $orgName ?></h6>
                                <p><?php echo $orgAddress ?></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Date</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">From</p>
                                        <h6 class="text-muted f-w-400"><?php echo $from_date ?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">To</p>
                                        <h6 class="text-muted f-w-400"><?php echo $to_date ?></h6>
                                    </div>
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Description</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">items</p>
                                        <h6 class="text-muted f-w-400"><?php echo $description ?></h6>
                                    </div>
                                    <!-- <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Most Viewed</p>
                                        <h6 class="text-muted f-w-400">Dinoter husainm</h6>
                                    </div> -->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class=" col-lg-6 col-md-8">
            <div class="card p-3">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h2 class="heading text-center">Donation Window</h2>
                    </div>
                </div>
                <form class="form-card" method="POST" action="confirmDonation.php">
                    <!-- <div class="row justify-content-center mb-4 radio-group">
                        <div class="col-sm-3 col-5">
                            <div class='radio selected mx-auto' data-value="dk"> <img class="fit-image" src="https://i.imgur.com/5TqiRQV.jpg" width="105px" height="55px"> </div>
                        </div>
                        <div class="col-sm-3 col-5">
                            <div class='radio mx-auto' data-value="visa"> <img class="fit-image" src="https://i.imgur.com/OdxcctP.jpg" width="105px" height="55px"> </div>
                        </div>
                        <div class="col-sm-3 col-5">
                            <div class='radio mx-auto' data-value="master"> <img class="fit-image" src="https://i.imgur.com/WIAP9Ku.jpg" width="105px" height="55px"> </div>
                        </div>
                        <div class="col-sm-3 col-5">
                            <div class='radio mx-auto' data-value="paypal"> <img class="fit-image" src="https://i.imgur.com/cMk1MtK.jpg" width="105px" height="55px"> </div>
                        </div> <br>
                    </div> -->
                    <div class="row justify-content-center mb-4 radio-group">
                        <!-- <div class="col-12 px-auto">
                        </div> -->
                        <div class="col-sm-3 col-5">
                        <div class="custom-control custom-radio custom-control-inline"> <input id="customRadioInline1" type="radio" name="channel" class="custom-control-input" checked="true" value="DK"> <label for="customRadioInline1" class="custom-control-label label-radio"><img class="fit-image" src="https://i.imgur.com/5TqiRQV.jpg" width="90px" height="55px"></label> </div>
                        </div>
                        <div class="col-sm-3 col-5">
                        <div class="custom-control custom-radio custom-control-inline"> <input id="customRadioInline2" type="radio" name="channel" class="custom-control-input" value="Visa"> <label for="customRadioInline2" class="custom-control-label label-radio"><img class="fit-image" src="https://i.imgur.com/OdxcctP.jpg" width="90px" height="55px"></label> </div>
                        </div>
                        <div class="col-sm-3 col-5">
                        <div class="custom-control custom-radio custom-control-inline"> <input id="customRadioInline3" type="radio" name="channel" class="custom-control-input" value="Master"> <label for="customRadioInline3" class="custom-control-label label-radio"><img class="fit-image" src="https://i.imgur.com/WIAP9Ku.jpg" width="90px" height="55px"></label> </div>
                        </div>
                        <div class="col-sm-3 col-5">
                        <div class="custom-control custom-radio custom-control-inline"> <input id="customRadioInline4" type="radio" name="channel" class="custom-control-input" value="PayPal"> <label for="customRadioInline4" class="custom-control-label label-radio"><img class="fit-image" src="https://i.imgur.com/cMk1MtK.jpg" width="90px" height="55px"></label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input name="amount" placeholder="RM100" type=number min=1 step=0.01 required> <label>Amount</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" name="name" placeholder="John Doe" required> <label>Name</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="input-group"> <input type="text" id="cr_no" name="card-no" placeholder="0000 0000 0000 0000" minlength="19" maxlength="19" required> <label>Card Number</label> </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group"> <input type="text" id="exp" name="expdate" placeholder="MM/YY" minlength="5" maxlength="5" required> <label>Expiry Date</label> </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group"> <input type="password" name="cvv" placeholder="&#9679;&#9679;&#9679;" minlength="3" maxlength="3" required> <label>CVV</label> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12"> <input type="submit" value="Donate" class="btn btn-pay placeicon"> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

?>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){

//For Card Number formatted input
var cardNum = document.getElementById('cr_no');
cardNum.onkeyup = function (e) {
if (this.value == this.lastValue) return;
var caretPosition = this.selectionStart;
var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
var parts = [];

for (var i = 0, len = sanitizedValue.length; i < len; i +=4) { parts.push(sanitizedValue.substring(i, i + 4)); } for (var i=caretPosition - 1; i>= 0; i--) {
    var c = this.value[i];
    if (c < '0' || c> '9') {
        caretPosition--;
        }
        }
        caretPosition += Math.floor(caretPosition / 4);

        this.value = this.lastValue = parts.join('-');
        this.selectionStart = this.selectionEnd = caretPosition;
        }

        //For Date formatted input
        var expDate = document.getElementById('exp');
        expDate.onkeyup = function (e) {
        if (this.value == this.lastValue) return;
        var caretPosition = this.selectionStart;
        var sanitizedValue = this.value.replace(/[^0-9]/gi, '');
        var parts = [];

        for (var i = 0, len = sanitizedValue.length; i < len; i +=2) { parts.push(sanitizedValue.substring(i, i + 2)); } for (var i=caretPosition - 1; i>= 0; i--) {
            var c = this.value[i];
            if (c < '0' || c> '9') {
                caretPosition--;
                }
                }
                caretPosition += Math.floor(caretPosition / 2);

                this.value = this.lastValue = parts.join('/');
                this.selectionStart = this.selectionEnd = caretPosition;
                }

                // Radio button
                $('.radio-group .radio').click(function(){
                $(this).parent().parent().find('.radio').removeClass('selected');
                $(this).addClass('selected');
                });
                })
</script>