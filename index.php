<?php
    session_start();
    include('includes/dbconn.php');
    if(isset($_POST['login']))
    {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password = md5($password);
    $stmt=$mysqli->prepare("SELECT email,password,id FROM userregistration WHERE email=? and password=? ");
        $stmt->bind_param('ss',$email,$password);
        $stmt->execute();
        $stmt -> bind_result($email,$password,$id);
        $rs=$stmt->fetch();
         $stmt->close();
        $_SESSION['id']=$id;
        $_SESSION['login']=$email;
        $uip=$_SERVER['REMOTE_ADDR'];
        $ldate=date('d/m/Y h:i:s', time());
         if($rs){
            $uid=$_SESSION['id'];
            $uemail=$_SESSION['login'];
        $ip=$_SERVER['REMOTE_ADDR'];
        $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
        $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
        $city = $addrDetailsArr['geoplugin_city'];
        $country = $addrDetailsArr['geoplugin_countryName'];
        $log="insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
        $mysqli->query($log);
        if($log){
            header("location:student/dashboard.php");
                 }
        } else {
            echo "<script>alert('Sorry, Invalid Username/Email or Password!');</script>";
               }
   }
?>

<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Hostel Management System</title>
    <!-- Custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body{
    margin: 0;
    background-color: #000;
    color: #eee;
    font-family: Poppins;
    font-size: 12px;
}
header {
    position: fixed;
    top: 0;
    left: 0;
    width: 160%;
    height: 100vh; /* Set the height to cover the full viewport height */
    background-color: rgba(0, 0, 0, 0.8); /* Adjust the background color and transparency as needed */
    z-index: 1000; /* Ensure the navigation bar stays on top of other content */
}

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        body {
            margin: 0;
            background-color: #000;
            color: #eee;
            font-family: Poppins;
            font-size: 12px;
        }
        a {
            text-decoration: none;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        header nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 80%;
            max-width: 1140px;
        }
        header a {
            font-size: 2vh;
            color: #eee;
        }

a{
    text-decoration: none;
}
header{
    width: 1140px;
    max-width: 150%;
    margin: auto;
    height: 50px;
    display: flex;
    align-items: center;
    position: relative;
    z-index: 100;
}
header a{
	font-size: 2vh;
    color: #eee;
    margin-right: 40px;
}
/* carousel */
.carousel{
    height: 100vh;
    margin-top: -50px;
    width: 100vw;
    overflow: hidden;
    position: relative;
}
.carousel .list .item{
    width: 100%;
    height: 100%;
    position: absolute;
    inset: 0 0 0 0;
}
.author{
	font-size: 2vh;
}
.des{
	font-size: 1.5vh;
	color: #000000;
	-webkit-text-stroke-color:  #000000;
	-webkit-text-stroke-width: 0.1px;
}
.carousel .list .item img{
    width: 100%;
    height: 100%;
    object-fit: cover;
	filter: blur(8px);
}
.carousel .list .item .content{
    position: absolute;
    top: 20%;
    width: 1140px;
    max-width: 80%;
    left: 50%;
    transform: translateX(-50%);
    padding-right: 30%;
    box-sizing: border-box;
    color: #fff;
    text-shadow: 0 5px 15px #0004;
}
.carousel .list .item .author{
    font-weight: bold;
    letter-spacing: 10px;
}
.carousel .list .item .title,
.carousel .list .item .topic{
    font-size: 5em;
    font-weight: bold;
    line-height: 1.3em;
}
.carousel .list .item .topic{
    color: #f1683a;
}
.carousel .list .item .buttons{
    display: grid;
    grid-template-columns: repeat(2, 130px);
    grid-template-rows: 40px;
    gap: 5px;
    margin-top: 20px;
}
.carousel .list .item .buttons button{
    border: none;
    background-color: #eee;
    letter-spacing: 3px;
    font-family: Poppins;
    font-weight: 500;
}
.carousel .list .item .buttons button:nth-child(2){
    background-color: transparent;
    border: 1px solid #fff;
    color: #eee;
}
/* thumbail */
.thumbnail{
    position: absolute;
    bottom: 50px;
    left: 50%;
    width: max-content;
    z-index: 100;
    display: flex;
    gap: 20px;
}
.thumbnail .item{
    width: 150px;
    height: 220px;
    flex-shrink: 0;
    position: relative;
}
.thumbnail .item img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px;
}
.thumbnail .item .content{
    color: #fff;
    position: absolute;
    bottom: 10px;
    left: 10px;
    right: 10px;
}
.thumbnail .item .content .title{
    font-weight: 500;
}
.thumbnail .item .content .description{
    font-weight: 300;
}
/* arrows */
.arrows{
    position: absolute;
    top: 80%;
    right: 52%;
    z-index: 100;
    width: 300px;
    max-width: 30%;
    display: flex;
    gap: 10px;
    align-items: center;
}
.arrows button{
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #eee4;
    border: none;
    color: #fff;
    font-family: monospace;
    font-weight: bold;
    transition: .5s;
}
.arrows button:hover{
    background-color: #fff;
    color: #000;
}

/* animation */
.carousel .list .item:nth-child(1){
    z-index: 1;
}

/* animation text in first item */

.carousel .list .item:nth-child(1) .content .author,
.carousel .list .item:nth-child(1) .content .title,
.carousel .list .item:nth-child(1) .content .topic,
.carousel .list .item:nth-child(1) .content .des,
.carousel .list .item:nth-child(1) .content .buttons
{
    transform: translateY(50px);
    filter: blur(20px);
    opacity: 0;
    animation: showContent .5s 1s linear 1 forwards;
}
@keyframes showContent{
    to{
        transform: translateY(0px);
        filter: blur(0px);
        opacity: 1;
    }
}
.carousel .list .item:nth-child(1) .content .title{
    animation-delay: 1.8s!important;
}
.carousel .list .item:nth-child(1) .content .topic{
    animation-delay: 2.8s!important;
}
.carousel .list .item:nth-child(1) .content .des{
    animation-delay: 3.8s!important;
}
.carousel .list .item:nth-child(1) .content .buttons{
    animation-delay: 4.8s!important;
}
/* create animation when next click */
.carousel.next .list .item:nth-child(1) img{
    width: 150px;
    height: 220px;
    position: absolute;
    bottom: 50px;
    left: 50%;
    border-radius: 30px;
    animation: showImage .5s linear 1 forwards;
}
@keyframes showImage{
    to{
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 0;
    }
}

.carousel.next .thumbnail .item:nth-last-child(1){
    overflow: hidden;
    animation: showThumbnail .5s linear 1 forwards;
}
.carousel.prev .list .item img{
    z-index: 100;
}
@keyframes showThumbnail{
    from{
        width: 0;
        opacity: 0;
    }
}
.carousel.next .thumbnail{
    animation: effectNext .5s linear 1 forwards;
}

@keyframes effectNext{
    from{
        transform: translateX(150px);
    }
}

/* running time */

.carousel .time{
    position: absolute;
    z-index: 1000;
    width: 0%;
    height: 3px;
    background-color: #f1683a;
    left: 0;
    top: 0;
}

.carousel.next .time,
.carousel.prev .time{
    animation: runningTime 3s linear 1 forwards;
}
@keyframes runningTime{
    from{ width: 100%}
    to{width: 0}
}


/* prev click */

.carousel.prev .list .item:nth-child(2){
    z-index: 2;
}

.carousel.prev .list .item:nth-child(2) img{
    animation: outFrame 0.5s linear 1 forwards;
    position: absolute;
    bottom: 0;
    left: 0;
}
@keyframes outFrame{
    to{
        width: 150px;
        height: 220px;
        bottom: 50px;
        left: 50%;
        border-radius: 20px;
    }
}

.carousel.prev .thumbnail .item:nth-child(1){
    overflow: hidden;
    opacity: 0;
    animation: showThumbnail .5s linear 1 forwards;
}
.carousel.next .arrows button,
.carousel.prev .arrows button{
    pointer-events: none;
}
.carousel.prev .list .item:nth-child(2) .content .author,
.carousel.prev .list .item:nth-child(2) .content .title,
.carousel.prev .list .item:nth-child(2) .content .topic,
.carousel.prev .list .item:nth-child(2) .content .des,
.carousel.prev .list .item:nth-child(2) .content .buttons
{
    animation: contentOut 1.5s linear 1 forwards!important;
}

@keyframes contentOut{
    to{
        transform: translateY(-150px);
        filter: blur(20px);
        opacity: 0;
    }
}
@media screen and (max-width: 678px) {
    .carousel .list .item .content{
        padding-right: 0;
    }
    .carousel .list .item .content .title{
        font-size: 30px;
    }
}
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="#">Home</a>
            <a href="admin/index.php">Admin Signin</a>
            <a href="st.php">Student</a>
        
            <a href="contact.html">contact</a>
        </nav>
    </header>

    <!-- carousel -->
    <div class="carousel">
        <!-- list item -->
        <div class="list">
            <div class="item">
                <img src="image/img1.jpg">
                <div class="content">
                    <div class="author">Group 2</div>
                    <div class="title">Hostel Services</div>
                    <div class="topic">Customized City Tours</div>
                    <div class="des">
                        <!-- lorem 50 -->
                        Hostels can offer personalized city tours led by knowledgeable locals. Guests can choose from various tour themes such as historical, culinary, or cultural. These tours could be small-group experiences, allowing guests to explore the city's hidden gems while making new friends from around the world.
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img2.jpg">
                <div class="content">
                    <div class="author">Group 2</div>
                    <div class="title">Hostel Services</div>
                    <div class="topic">Social Events and Workshops</div>
                    <div class="des">
                        Organizing regular social events and workshops within the hostel can create a vibrant community atmosphere. These events could include language exchange nights, cooking classes featuring local cuisine, movie nights, or even skill-sharing workshops like photography or yoga. It's a great way for guests to interact with each other and immerse themselves in the local culture.
                    </div>
                    <div class="buttons">
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img3.jpg">
                <div class="content">
                    <div class="author">Group 2</div>
                    <div class="title">Hostel Services</div>
                    <div class="topic">Eco-Friendly Initiatives</div>
                    <div class="des">
                        Many travelers are increasingly conscious of their environmental footprint. Hostels can implement eco-friendly initiatives such as recycling programs, energy-efficient lighting, and water-saving measures. Additionally, they could organize volunteer activities like beach clean-ups or tree planting, allowing guests to contribute positively to the local environment during their stay.
                    </div>

                </div>
            </div>
            <div class="item">
                <img src="image/img4.jpg">
                <div class="content">
                    <div class="author">Group 2</div>
                    <div class="title">Hostel Services</div>
                    <div class="topic">Digital Nomad Services</div>
                    <div class="des">
                        With the rise of remote work and digital nomadism, hostels can cater to this demographic by offering amenities tailored to their needs. This could include high-speed internet access, designated co-working spaces with comfortable desks and ergonomic chairs, and printing/scanning facilities. Some hostels might even provide networking events or skill-sharing sessions specifically aimed at digital nomads, creating a supportive community for remote workers on the move.
                    </div>
                </div>
            </div>
        </div>
        <!-- list thumnail -->
        <div class="thumbnail">
            <div class="item">
                <img src="image/img1.jpg">
                <div class="content">
                    <div class="title">
                        Customized City Tours
                    </div>
                    <div class="description">
                        Read More
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img2.jpg">
                <div class="content">
                    <div class="title">
                        Social Events and Workshops
                    </div>
                    <div class="description">
                        Read More
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img3.jpg">
                <div class="content">
                    <div class="title">
                        Eco-Friendly Initiatives
                    </div>
                    <div class="description">
                        Read More
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="image/img4.jpg">
                <div class="content">
                    <div class="title">
                        Digital Nomad Services
                    </div>
                    <div class="description">
                        Read More
                    </div>
                </div>
            </div>
        </div>
        <!-- next prev -->

        <div class="arrows">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <!-- time running -->
        <div class="time"></div>
    </div>

    <script>
        //step 1: get DOM
let nextDom = document.getElementById('next');
let prevDom = document.getElementById('prev');

let carouselDom = document.querySelector('.carousel');
let SliderDom = carouselDom.querySelector('.carousel .list');
let thumbnailBorderDom = document.querySelector('.carousel .thumbnail');
let thumbnailItemsDom = thumbnailBorderDom.querySelectorAll('.item');
let timeDom = document.querySelector('.carousel .time');

thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
let timeRunning = 3000;
let timeAutoNext = 7000;

nextDom.onclick = function(){
    showSlider('next');    
}

prevDom.onclick = function(){
    showSlider('prev');    
}
let runTimeOut;
let runNextAuto = setTimeout(() => {
    next.click();
}, timeAutoNext)
function showSlider(type){
    let  SliderItemsDom = SliderDom.querySelectorAll('.carousel .list .item');
    let thumbnailItemsDom = document.querySelectorAll('.carousel .thumbnail .item');
    
    if(type === 'next'){
        SliderDom.appendChild(SliderItemsDom[0]);
        thumbnailBorderDom.appendChild(thumbnailItemsDom[0]);
        carouselDom.classList.add('next');
    }else{
        SliderDom.prepend(SliderItemsDom[SliderItemsDom.length - 1]);
        thumbnailBorderDom.prepend(thumbnailItemsDom[thumbnailItemsDom.length - 1]);
        carouselDom.classList.add('prev');
    }
    clearTimeout(runTimeOut);
    runTimeOut = setTimeout(() => {
        carouselDom.classList.remove('next');
        carouselDom.classList.remove('prev');
    }, timeRunning);

    clearTimeout(runNextAuto);
    runNextAuto = setTimeout(() => {
        next.click();
    }, timeAutoNext)
}
function changetxt(){
    document.getElementById("Change").innerHTML="wtf"
}
    </script>
</body>
</html>
