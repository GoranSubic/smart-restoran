/**
 * Created by Goran on 26-Aug-15.
 */
var username;
//username = prompt ("Welcome to the page about CSS, Bootstrap and JavaScript! Please enter your name:","Your Name"");
username = prompt ("Welcome to the page about CSS, Bootstrap and JavaScript!\n\nPlease enter your name","Your Name");
var x;
var email;
var pass;

$(document).ready(function(){

    //The toggle method toggles the collapsible content.
    $(".sakrij").click(function(){
        if (x == true) {
            //if ((email == "gsubic@gmail.com" && pass == "1234") || (email == "jmirkov2@gmail.com" && pass == "drvarska2")){
            promenljiva = "Prikazi";
            document.getElementById("promeni").innerHTML = promenljiva + " SlideShow!";
            window.alert("	It was my pleasure!!! \n\n	Thank you and good by!!! ");
            x = false;
            $(".collapse").collapse('toggle');
            //}
        } else {
            //alert ("X value is: " + Boolean(x));	//it is false on start...
            //username = prompt ("Please enter your name","Your Name");
            email = prompt ("Please enter your email","Your E-mail");
            pass = prompt ("Please enter your password","Your password");
            if ((email == "gsubic@gmail.com" && pass == "1234") || (email == "jmirkov2@gmail.com" && pass == "drvarska2")){
                $(".collapse").collapse('toggle');
                x = true;
                promenljiva = "Sakri";
                document.getElementById("promeni").innerHTML = promenljiva + " SlideShow!";
                document.getElementById("username").innerHTML = username;
                //document.write("Comment line document.write... in script code to show SlideShow..."); //This vay don't work fine
            }
        }
    });

    // Activate Carousel
    $("#myCarousel").carousel({interval: 2500, pause: "hover", wrap: true});

    // Click on the button to start sliding
    $("#myBtn").click(function(){
        $("#myCarousel").carousel("cycle");
    });

    // Click on the button to stop sliding
    $("#myBtn2").click(function(){
        $("#myCarousel").carousel("pause");
    });

    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#myCarousel").carousel(2);
    });
    $(".item4").click(function(){
        $("#myCarousel").carousel(3);
    });
    $(".item5").click(function(){
        $("#myCarousel").carousel(4);
    });
    $(".item6").click(function(){
        $("#myCarousel").carousel(5);
    });
    $(".item7").click(function(){
        $("#myCarousel").carousel(6);
    });
    $(".item8").click(function(){
        $("#myCarousel").carousel(7);
    });
    $(".item9").click(function(){
        $("#myCarousel").carousel(8);
    });
    $(".item10").click(function(){
        $("#myCarousel").carousel(9);
    });
    $(".item11").click(function(){
        $("#myCarousel").carousel(10);
    });

    // Enable Carousel Controls
    $(".left").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".right").click(function(){
        $("#myCarousel").carousel("next");
    });
    /*$("#myCarousel").on('slide.bs.carousel', function () {
     alert('A new slide is about to be shown!');
     });*/

});