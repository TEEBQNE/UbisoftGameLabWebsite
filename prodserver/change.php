<?php include 'process.php'?> 

<?php
// <!-- Page for user to change user name -->
// redirect to index page if username is not set
if (isset($_SESSION['username']) == false)
{
	echo '<meta http-equiv="refresh" content="0; URL=/">';
	exit;
}

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/png" href="WebsiteArt/favicon.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Change Name</title>
  <link rel="stylesheet" href="index.css">
   <script src="jquery.min.js"></script>
   <script>
	 $(function () {

		// if the form submission is triggered...
        $('form').on('submit', function (e) {

		 // stops page reload on form submission (in case of an 'error' for the submission)
          e.preventDefault();
          
         // temp variable to post to server for validation of name
         var localName = $('#theNewUsername').val();
			$.ajax({
				type: 'post',
				url: 'process',
				data:
				{
					 newusername:localName
				},
				success: function (data) {
				
				  // verifies the success of the post
				  if(data.indexOf("success") >= 0)
				  {
				  	  // NOTE:: localStorage is disabled on iOS after v. 8.3 (or 4?)
				  	  // This feature of a retained user session only works on older models,
				  	  // android or desktop. Not looking for an alternative for the prototype.
				  	  // The session storage still works. That should be a long enough duration
				  	  // for the 'test'.
				  
					  // set the storage variable to the new name if post is successful and 
					  // name entered is valid (under 10 chars, [a-zA-Z0-9 ]
					  localStorage.setItem('doc_username', localName);
					  
					  // redirect to the lobby page after setting
					  window.location.replace("lobby");
				  }
				  else
				  {
				    // if the post failed, print the error that is returned and clear the input box
					$('#theNewUsername').val('');
					$("#errorMessage").text(data);  
				  }  
				}
			  });
        });

      });

	function InvalidMsg(textbox)
        {
                if(textbox.validity.patternMismatch){
                textbox.setCustomValidity('Invalid Name! Please only enter letters, numbers and/or spaces.');
        }    
        else {
                textbox.setCustomValidity('');
        }
                return true;
        }
  </script>
</head>
<body>
 <p id = "errorMessage"></p>
 <div class="rlform">
  <div class="rlform rlform-wrapper">
   <div class="rlform-box">
    <div class="rlform-box-inner">
   <form name="newusername">
    <p>Enter a new Username</p>
    <p>Note: This will leave your old one up for grabs</p>
    <div class="rlform-group">
    
    <!-- Verifies the input based on regex to block anything other than numerical or alphabetic symbols along with space key -->
     <input id="theNewUsername" pattern="[A-Za-z0-9 ]*" onvalid=";" oninvalid="InvalidMsg(this);"  onchange="try{setCustomValidity('')}catch(e){}" 
  onkeypress="try{setCustomValidity('')}catch(e){}" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="off" type="username" name="newusername" class="rlform-input" placeholder='New Username' autocomplete="off"required>
    </div>
   </form>
  </div>
   </div>
     </div>
 </div>
 </body>
</html>
