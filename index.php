<?php
session_start();

$hostname_surachet = "localhost";
$database_surachet = "surache1_room1g4";
$username_surachet = "surache1_room1g4";
$password_surachet = "NAA12547";
$surachet = mysql_pconnect($hostname_surachet, $username_surachet, $password_surachet) or trigger_error(mysql_error(),E_USER_ERROR);
mysql_select_db($database_surachet, $surachet);

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["login"] == "Yes") {
  $Username = $_POST['Username'];
  $password = $_POST['Password'];

  $strSQL = "SELECT * FROM Member WHERE (Username = '$Username' OR Email = '$Username') AND Password = '$password'";
  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);

  if(!$objResult)
	{
			echo '<script>alert("Username or Password Incorrect!")</script>';
	}
	else
	{
			$_SESSION["UserID"] = $objResult["IDMember"];
			$_SESSION["Status"] = $objResult["UserType"];

			session_write_close();

			if($objResult["UserType"] == 1)
			{
				header("location:index1.php");
			}
			else
			{
				header("location:member.php?sid=".$objResult['IDMember']);
			}
	}
}
?>

<html>
<head>
  <title="Log in">
  <meta charset="utf-8">
  <style>
@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400');
body, html {
  font-family: 'Source Sans Pro', sans-serif;
  background-color: #1d243d;
  padding: 0;
  margin: 0;
}
#particles-js {
  position: absolute;
  width: 100%;
  height: 100%;
}
.container{
  margin: 0;
  top: 50px;
  left: 50%;
  position: absolute;
  text-align: center;
  transform: translateX(-50%);
  background-color: rgb( 33, 41, 66 );
  border-radius: 9px;
  border-top: 10px solid #79a6fe;
  border-bottom: 10px solid #8BD17C;
  width: 600px;
  height: 550px;
  box-shadow: 1px 1px 108.8px 19.2px rgb(25,31,53);
}

.box h2 {
  font-family: 'Source Sans Pro', sans-serif;
  color: #5c6bc0;
  font-size: 30px;
  margin-top:80px;;
}

.box h2 span {
  color: #dfdeee;
  font-weight: lighter;
}

.box h5 {
  font-family: 'Source Sans Pro', sans-serif;
  font-size: 13px;
  color: #a1a4ad;
  letter-spacing: 1.5px;
  margin-top: -15px;
  margin-bottom: 50px;
}

.box input[type = "text"],.box input[type = "password"] {
  display: block;
  margin: 20px auto;
  background: #262e49;
  border: 0;
  border-radius: 5px;
  padding: 14px 10px;
  width: 80%;
  font-size: 20px;
  outline: none;
  color: #d6d6d6;
      -webkit-transition: all .2s ease-out;
    -moz-transition: all .2s ease-out;
    -ms-transition: all .2s ease-out;
    -o-transition: all .2s ease-out;
    transition: all .2s ease-out;

}
::-webkit-input-placeholder {
  color: #565f79;
}

.box input[type = "text"]:focus,.box input[type = "password"]:focus {
  border: 1px solid #79A6FE;

}

a{
  color: #5c7fda;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}

 label input[type = "checkbox"] {
  display: none; /* hide the default checkbox */
}

/* style the artificial checkbox */
label span {
  height: 13px;
  width: 13px;
  border: 2px solid #464d64;
  border-radius: 2px;
  display: inline-block;
  position: relative;
  cursor: pointer;
  float: left;
  left: 7.5%;
}

.btn1 {
  border:0;
  background: #7f5feb;
  color: #dfdeee;
  border-radius: 100px;
  width: 60%;
  height: 49px;
  font-size: 16px;
  position: inherit;
  margin-top: 30px;
  top: 79%;
  left: 8%;
  transition: 0.3s;
  cursor: pointer;
}

.btn1:hover {
  background: #5d33e6;
}

.rmb {
  position: absolute;
  margin-left: -24%;
  margin-top: 0px;
  color: #dfdeee;
  font-size: 13px;
}

.forgetpass {
  position: relative;
  float: right;
  right: 28px;
}

.dnthave{
    position: inherit;
    top: 92%;
    left: 24%;
}

[type=checkbox]:checked + span:before {/* <-- style its checked state */
    font-family: FontAwesome;
    font-size: 16px;
    content: "\f00c";
    position: absolute;
    top: -4px;
    color: #896cec;
    left: -1px;
    width: 13px;
}

.typcn {
  position: absolute;
  left: 339px;
  top: 282px;
  color: #3b476b;
  font-size: 22px;
  cursor: pointer;
}

.typcn.active {
  color: #7f60eb;
}

.error {
  background: #ff3333;
  text-align: center;
  width: 337px;
  height: 20px;
  padding: 2px;
  border: 0;
  border-radius: 5px;
  margin: 10px auto 10px;
  position: absolute;
  top: 31%;
  left: 7.2%;
  color: white;
  display: none;
}

.footer {
    position: relative;
    left: 0;
    bottom: 0;
    top: 605px;
    width: 100%;
    color: #78797d;
    font-size: 14px;
    text-align: center;
}

.footer .fa {
  color: #7f5feb;;
}
@media (max-width: 450px){
  .container{
    width: 100%;
    height: auto;
    border-top: 15px solid #79a6fe;
    border-bottom: 10px solid #8BD17C;
    padding-bottom: 20px;
  }
}
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="animated bounceInDown">
  <div class="container">
    <span class="error animated tada" id="msg"></span>
    <form name="login" class="box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <h2>Log in</h2>
      <h5>Sign in to your account.</h5>
        <input type="text" name="Username" id="Username" required placeholder="Username or Email" autocomplete="off">
        <i class="typcn typcn-eye" id="eye"></i>
        <input type="password" name="Password" id="Password" required placeholder="Passsword" id="pwd" autocomplete="off">
        <input type="submit" value="Sign in" class="btn1">
        <input type="hidden" name="login" value="Yes" />
      </form>
        <center><br><br><a href="register.php" class="dnthave">Don’t have an account? Sign up</a></center>
  </div>

</div>

<script>
var pwd = document.getElementById('pwd');
var eye = document.getElementById('eye');

eye.addEventListener('click',togglePass);

function togglePass(){

   eye.classList.toggle('active');

   (pwd.type == 'password') ? pwd.type = 'text' : pwd.type = 'password';
}

// Form Validation

function checkStuff() {
  var email = document.form1.email;
  var password = document.form1.password;
  var msg = document.getElementById('msg');

  if (email.value == "") {
    msg.style.display = 'block';
    msg.innerHTML = "Please enter your email";
    email.focus();
    return false;
  } else {
    msg.innerHTML = "";
  }

   if (password.value == "") {
    msg.innerHTML = "Please enter your password";
    password.focus();
    return false;
  } else {
    msg.innerHTML = "";
  }
   var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!re.test(email.value)) {
    msg.innerHTML = "Please enter a valid email";
    email.focus();
    return false;
  } else {
    msg.innerHTML = "";
  }
}

// ParticlesJS

// ParticlesJS Config.
particlesJS("particles-js", {
  "particles": {
    "number": {
      "value": 60,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "#ffffff"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.1,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 6,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.1,
      "width": 2
    },
    "move": {
      "enable": true,
      "speed": 1.5,
      "direction": "top",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "repulse"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
</script>
</body>
</html>
