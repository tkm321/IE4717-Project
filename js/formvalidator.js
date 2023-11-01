// CONTACT FORM START
function validateName() {
    var namefield = document.getElementById("name").value;
    var namepattern = /^[a-zA-Z]+(\s+[a-zA-Z]+)*$/;
    
    if (namepattern.test(namefield))
    {
      return true;
    }
    else if (namefield = null || namefield == "")
    {
      return false;
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
    else if (emailfield = null || emailfield == "")
    {
    return false;
    }
    else
    {
    alert("Invalid email format.\nPlease ensure your email is in the following format:\n<Username that contains only word characters, hyphen(-) and period(.)>@<Domain name that contains only two to four address extensions with each extension separated by a period(.) with last extension having 2-3 characters>\n\nEXAMPLES:\nAllowed: sam-95@gmail.com, tom.ng@ntu.edu.sg, jean@send.q.com.sg\nNot allowed: john@sg, mr+tan@edu.com.g, lisa@my.edu.roam.org.sg");
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
    else if (contactfield = null || contactfield == "")
    {
        return false;
    }
    else
    {
        alert("Please enter a valid 8-digit Singapore phone number starting with either 6, 8 or 9.");
        return false;
    }
}

function validateForm() {
    var confirmName = validateName();
    var confirmEmail = validateEmail();
    var confirmContact = validateContact();
    
    if (confirmName && confirmEmail && confirmContact)
    {
      alert("Form successfully submitted!");
      return true;
    }
    else
    {
      return false;
    }
  }
// CONTACT FORM END