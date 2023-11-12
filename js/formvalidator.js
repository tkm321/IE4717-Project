function validateName() {
  var namefield = document.getElementById("name").value;
  var namepattern = /^[a-zA-Z]+(\s+[a-zA-Z]+)*$/;
  
  if (namepattern.test(namefield))
  {
    return true;
  }
  else
  {
    alert("Please ensure your name is in the following format:\n- Your name should contain only word characters and spaces.\n- There should not be any extra white spaces at the front or back of your name or by itself.");
    return false;
  }
}

function validateEmail() {
  var emailfield = document.getElementById("email").value;
  var emailpattern = /^[\w.-]+@([a-zA-Z]+\.){1,3}[a-zA-Z]{2,3}$/;

  if (emailpattern.test(emailfield))
  {
    return true;
  }
  else
  {
  alert("Invalid email format.\nPlease ensure your email is in the following format:\n<Username that contains only word characters, hyphen(-), underscore(_) and period(.)>@<Domain name that contains only two to four address extensions with each extension separated by a period(.) with last extension having 2-3 characters>\n\nEXAMPLES:\nAllowed: sam-95@gmail.com, tom.ng@ntu.edu.sg, jean@send.q.com.sg\nNot allowed: john@sg, mr+tan@edu.com.g, lisa@my.edu.roam.org.sg");
    return false;
  }
}

function validateContact() {
  var contactfield = document.getElementById("contact").value;
  var contactpattern = /^(6|8|9)[0-9]{7}$/;

  if (contactpattern.test(contactfield))
  {
    return true;
  }
  else
  {
    alert("Please enter a valid 8-digit Singapore phone number starting with either 6, 8 or 9.");
    return false;
  }
}

function validateContactForm() {
  var confirmName = validateName();
  var confirmEmail = validateEmail();
  var confirmContact = validateContact();
  
  if (confirmName && confirmEmail && confirmContact)
  {
    alert("We have received your inquiry and will get back to you as soon as possible.");
    return true;
  }
  else
  {
    return false;
  }
}

function validatePassword() {
  var passwordfield = document.getElementById("password").value;
  var passwordpattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*\s).{8,}$/;
  
  if (passwordpattern.test(passwordfield))
  {
    return true;
  }
  else
  {
    alert("Please ensure your password meets the following requirements:\n- Minimum of eight characters \n- At least one uppercase letter\n- At least one lowercase letter\n- At least one number\n- Does not contain white spaces");
    return false;
  }
}

function validatePasswordSame() {
  var passwordfield = document.getElementById("password").value;
  var confirmpasswordfield = document.getElementById("confirmpassword").value;

  if (passwordfield == confirmpasswordfield)
  {
    return true; 
  }
  else
  { 
    alert("Passwords do not match.");
    return false;
  } 
}

function validateRegisterForm() {
  var confirmName = validateName();
  var confirmEmail = validateEmail();
  var confirmContact = validateContact();
  var confirmPassword = validatePassword();
  var confirmPasswordSame = validatePasswordSame();
  
  if (confirmName && confirmEmail && confirmContact && confirmPassword && confirmPasswordSame)
  {
    alert("Account registration successful. Welcome to NovaTech!");
    return true;
  }
  else
  {
    return false;
  }
}

function validateMessage(textarea) {
  const message = textarea.value;
  const words = message.split(/\s+/);
  if (words.length > 100) {
    // If more than 100 words, prevent additional input
    const truncatedMessage = words.slice(0, 100).join(" ");
    textarea.value = truncatedMessage;
  }
  
  // Limit the textarea to 100 words
  if (words.length >= 100) {
    textarea.setAttribute('maxlength', message.length);
  } else {
    textarea.removeAttribute('maxlength');
  }
}

function validateRating(input) {
	if (input.value < 0) {
		input.value = 0;
	} else if (input.value > 5) {
		input.value = 5;
	}
}

function validateReviewForm() {
  var confirmName = validateName();
  var confirmEmail = validateEmail();
  var confirmContact = validateContact();
  
  if (confirmName && confirmEmail && confirmContact)
  {
    return true;
  }
  else
  {
    return false;
  }
}

function validateitemForm() {
  var confirmName = validateName();
  var confirmEmail = validateEmail();
  var confirmContact = validateContact();
  
  if (confirmName && confirmEmail && confirmContact)
  {
    alert("We have received your inquiry and will get back to you as soon as possible.");
    return true;
  }
  else
  {
    return false;
  }
}

function validatePayment() {
  var paymentButtons = document.getElementsByName("payment");
  len = paymentButtons.length;

  for (var i = 0 ; i < len ; i++) {
    if (paymentButtons[i].checked) {
        return true;
    }
  }
  alert("Please select a payment method.");
  return false;
}

function validateCheckoutForm() {
  var confirmName = validateName();
  var confirmEmail = validateEmail();
  var confirmContact = validateContact();
  var confirmPayment = validatePayment();
  
  if (confirmName && confirmEmail && confirmContact && confirmPayment)
  {
    return true;
  }
  else
  {
    return false;
  }
}

function onlyNumberAndDecimal(evt)
{
  var ASCIINumDec = (evt.which) ? evt.which : evt.keyCode
  if (ASCIINumDec > 31 && (ASCIINumDec < 46 || ASCIINumDec == 47 || ASCIINumDec > 57) )
  {
    return false;
  }
  else
  {
    return true;
  }
}

function onlyNumber(evt)
{
  var ASCIINum = (evt.which) ? evt.which : evt.keyCode
  if (ASCIINum > 31 && (ASCIINum < 48 || ASCIINum > 57) )
  {
    return false;
  }
  else
  {
    return true;
  }
}

function validateInventoryForm() {
  // Select checkboxes with class 'checkbox'
  var checkboxes = document.querySelectorAll('.checkbox');
  
  // Convert into an array
  checkboxes = Array.from(checkboxes);

  // Check if any checkbox is selected
  var anyCheckboxSelected = checkboxes.some(function (checkbox) {
    return checkbox.checked;
  });

  if (anyCheckboxSelected)
  {
    return true;
  }
  else
  {
    alert('Please select at least an item to update.');
    return false;
  }
}