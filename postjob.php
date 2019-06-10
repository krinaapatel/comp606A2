<!DOCTYPE html>
<html>
	<head>
		<title>Post Job</title>
		<link rel="stylesheet" href="menu1.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="wrapper">
	  
    		<h1 >Post Job</h1>
    		<form  action="savejob.php" method="POST" enctype="multipart/form-data">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationServer01">Job Title</label>
                <input type="text" class="form-control is-valid" id="validationServer01" name="jobtitle" placeholder="job title" required>
                <div class="valid-feedback"> 
          	    </div>
          	  </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationServer02">Location</label>
                <input type="text" class="form-control is-valid" id="validationServer02" name="location" placeholder="enter city" required>
                <div class="valid-feedback">
                </div>
              </div>
            </div>
            <div class="form-row">   
              <div class="col-md-6 mb-3">
                <label for="validationServer04">Job Activation Date</label>
                <input type="text" class="form-control" name="jobactivationdate" placeholder="dd/mm/yyyy" required>
              </div>
            </div>
        	  <div class="form-row">
        		  <div class="col-md-6 mb-3">
        			   <label for="validationServer05">Job Completion Date</label>
        			   <input type="text" class="form-control"  name="jobcompletiondate" placeholder="dd/mm/yyyy" required>
        		  </div>
            </div>
            <div class="form-row">
        	    <div class="col-md-6 mb-3">
                <label for="validationServer03">Cost</label>
                <div class="input-group-prepend">
                  <span class="input-group-text"  id="inputGroupPrepend3">$</span>
                  <input type="text" class="form-control" name="cost" placeholder="cost" required >
                </div>
              </div>
            </div>
            <div class="form-row">
        	     <div class="col-md-6 mb-3">
                  <label for="validationServer03">Job Description</label>
                  <textarea rows="4" cols="50" class="form-control" name="jobdescription" placeholder="enter details(optional)"></textarea>
               </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
          </form>
        
    </div>
	</body>
</html>