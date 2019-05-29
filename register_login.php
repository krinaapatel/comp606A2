<?php
  include('header.php');
?>
<body>
	<!-- Top banner -->
 	<section class = "top-register-banner background-top-center">
      <div class = ""><img src = ""></div>
        <div class = "container">
          <div class = "row">
            <div class = "col-md-12 col-sm-12 col-xs-12">
              <div class = "top-banner-content register-hader">
                <a href = "#register" class = "btn btn-default bg-darkorange text-white">Register</a>
                <a href = "#login" class = "btn btn-default bg-darkorange text-white">Login</a>
              </div>
            </div>
          </div>
      </div>
    </section>

    <!-- Register section -->
 <section id = "register">
  <div class = "container">
    <div class = "row">
    	<div class = "col-sm-6 margin-right" id = "signup-form" >
    		<div id = "signup-inner">
    			<div class = "clearfix" id = "header">
        			<img id = "signup-icon" src = "./images/signup.png" alt = "" />
                	<h1>Register to SafeTrade.co.nz</h1>

                	<form id = "send" action = "">
		                <p>
		                <label for = "fname">First Name *</label>
		                <input id = "fname" type = "text" name = "fname" value = "" />
		                </p>

		                <p>
		                <label for = "name">Last Name *</label>
		                <input id = "lname" type = "text" name = "lname" value = "" />
		                </p>		                
		                
		                <p>
		                <label for = "email">Email *</label>
		                <input id = "email" type = "email" name = "email" value = "" required/>
		                </p>
		                
		                <p>
		                <label for = "password">Password *</label>
		                <input id = "password" type = "password" name = "password" value = "" required/>
		                </p>
		                
		                <p>
		                <label for = "phone">Phone</label>
		                <input id = "phone" type = "text" name = "phone" value = "" required/>
		                </p>
		                
		                <p class = "gender">
		                <label class = "gender" for = "gender">Gender :</label>
                    	<input type = "radio" name = "gender" value = "male"> Male
                    	<input type = "radio" name = "gender" value = "female"> Female
		                </p>
		                
		                <p>
		                <button id = "submit" class = "btn btn-default bg-darkorange text-white" type = "submit">Submit</button>
		                </p>
		                
		            </form>
                </div>	
    		</div>
    	</div>
    	<div class = "col-sm-6 login" id = "signup-form">
    		<div id = "signup-inner">
    			<div class = "clearfix" id = "header">
        			<img id = "signup-icon" src = "./images/signup.png" alt = "" />
                	<h1>Login to SafeTrade.co.nz</h1>

                	<form id = "send" action = "">
		                
		                <p>
		                <label for = "email">Email *</label>
		                <input id = "email" type = "email" name = "email" value = "" required />
		                </p>
		                
		                <p>
		                <label for = "password">Password *</label>
		                <input id = "password" type = "password" name = "password" value = "" required />
		                </p> 
		                
		                <p>
		                <button id = "submit" class = "btn btn-default bg-darkorange text-white" type = "submit">Submit</button>
		                </p>
		                
		            </form>
                </div>	
    		</div>
    	</div>
     </div>
 	</div>
 </section>

    
	<!-- Footer -->
	<?php
	  	include('footer.php');
	?>
	<!-- footer end-->

	  <!-- Bootstrap core JavaScript -->
	  <script src = "js/jquery-1.12.2.min.js"></script>
  </body>
</html>