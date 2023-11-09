<html>

    <head>
        <title> FAQ | Cherish</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../main/main_css/main.css">
    </head>

    <body>

        <?php
            include '../main/header.php';
        ?>
         <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/faq.png" class="d-block w-100" alt="..." height="500px" width="100%" style="filter: brightness(0.4);">
                    <div class="carousel-caption d-block caption-custom">
                        <h5 style="color: #ff5757; font-weight: bold">Cherish | Frequently Ask Question</h5>
                        <p style="color: #ff5757; font-weight: bold">Here are some of our frequently asked question from users and NGOs</p>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <section class="text-center">
        <button id="jumpIndividualSection" class="btn btn-primary"><a href="#individualFAQ" style="color: white;">Individual Users</a></button>
        <button id="jumpNgoSection" class="btn btn-primary"><a href="#NGOsFAQ" style="color: white;">NGOs</a></button>
        </section>
       
        <br/>

        <!--Charity by Category Section-->
        <h5 id="individualFAQ"><b>Frequently asked question of individual users:</b></h5>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#individualPanel_one" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    How Can I Donate To A Campaign
                </button>
                </h2>
                <div id="individualPanel_one" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        To donate to a campaign that is posted on our website, you will first need to <strong>register an individual account</strong> with us. After that, you can then
                        <strong>login</strong> with the account and select the campaign of your choice to donate to.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#individualPanel_two" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    How Can I Volunteer In An Activity
                </button>
                </h2>
                <div id="individualPanel_two" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        To volunteer in any activity posted on our website, you will first need to <strong>register an individual account</strong> with us. After that, you can then
                        <strong>login</strong> with the account and select the activity of your choice to volunteer in.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#individualPanel_three" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    What Is An Individual Account
                </button>
                </h2>
                <div id="individualPanel_three" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        An individual account is an account type that is used for <strong>individual user</strong> like you and me. You are your own and not representing any Non-profit organization.
                        This account allow you to donate to campaign and volunteer in activity. 
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#individualPanel_four" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                    Safety And Reliability Of The Campaign And Activity.
                </button>
                </h2>
                <div id="individualPanel_four" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        The CHERISH team are constantly on the lookout. Each time an NGO launch a new campaign or activity, our system will logged it and notify our admin team.
                        In addition, every update done by an NGO to a campaign or activity, our system will also notify the admin team that there are changes. If violation is detected,
                        our admin team can take it down immediately and we will issue refund or notice to the donors and volunteers. 
                        <br/><br/>
                        We also screen our registered NGO before they can begin to luanch campaign and activity. So rest assure, the CHERISH team has got your back.
                    </div>
                </div>
            </div>
        </div>

        <br/>
        <br/>

        <h5 id="NGOsFAQ"><b>Frequently asked question of NGOs:</b></h5>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ngoPanel_one" aria-expanded="false">
                        How Can I Launch A New Donation Campaign And Volunteer Activity
                    </button>
                </h2>
                <div id="ngoPanel_one" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        To launch a new donation campaign or volunteer activity, you must first <strong>register an NGO account with us</strong>. An NGO account, is an account type that is 
                        used for and to <strong>represent an Non-profit organization</strong>. The account will allow you to launch new campaign and activity with us.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ngoPanel_two" aria-expanded="false">
                        Why Am I Unable to Launch New Donation Campaign
                    </button>
                </h2>
                <div id="ngoPanel_two" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        To launch a new donation campaign, your NGO account must first be <strong>validate and approve by us</strong>. You can navigate to your profile, there you will
                        be able to see a Launch New Donation button. <strong>If you do not see the button, it might be that we have yet to verify and validate your profile</strong>. Kindly
                        contant us to find our more on the reason you are unable to launch a new donation campaign.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ngoPanel_three" aria-expanded="false">
                        Why Am I Unable to Launch New Volunteer Activity
                    </button>
                </h2>
                <div id="ngoPanel_three" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        To launch a new volunteer activity, your NGO account must first be <strong>validate and approve by us</strong>. You can navigate to your profile, there you will
                        be able to see a Launch New Volunteer button. <strong>If you do not see the button, it might be that we have yet to verify and validate your profile</strong>. Kindly
                        contant us to find our more on the reason you are unable to launch a new volunteer activity.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#ngoPanel_four" aria-expanded="false">
                        What Are The Allowed Category Of NGO organization
                    </button>
                </h2>
                <div id="ngoPanel_four" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        CHERISH currently support NGO that are listed as below categories:
                        <ul>
                            <li>Animal Welfare</li>
                            <li>Children Welfare</li>
                            <li>Education Support</li>
                            <li>Healthcare</li>
                            <li>Food Bank</li>
                            <li>Seniors Care</li>
                            <li>Mental Health</li>
                            <li>Environment Care</li>
                            <li>Differently Abled</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br/>

        <?php
            include "../main/footer.php";
        ?>

    </body>
</html>


