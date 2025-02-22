function toggleMenu() {
      let hbmenu = document.getElementById('hamburger-menu');
      let menuOptions = document.querySelectorAll('.menu-option');

      hbmenu.classList.toggle('active');
      menuOptions.forEach(option => {
            option.classList.toggle('show');
      });
}

function checkIfMatched() {

      let first = document.forms["changeemailform"]["newemail"].value;
      let second = document.forms["changeemailform"]["repeatemail"].value;

      let firstFieldValidation = document.getElementById('first-validation-img');
      let secondFieldValidation = document.getElementById('second-validation-img');

      if (first.includes('@') && first.length > 4) {
            firstFieldValidation.classList.add("validation-img-correct")
      }
      else {
            firstFieldValidation.classList.remove("validation-img-correct")
      }

      if (second != "") {
            secondFieldValidation.classList.add("validation-img-error")
      }

      if (first == second) {
            secondFieldValidation.classList.remove("validation-img-error")
            secondFieldValidation.classList.add("validation-img-correct")
      }
}

function CheckIfValidPw() {
      let pw = document.getElementById("newpw").value;

      let lengthValidationImg = document.getElementById('length-validation-img');
      let lowerValidationImg = document.getElementById('lower-validation-img');
      let upperValidationImg = document.getElementById('upper-validation-img');
      let numberValidationImg = document.getElementById('number-validation-img');
      let specialcharValidationImg = document.getElementById('specialchar-validation-img');

      if (pw.length >= 8) {
            lengthValidationImg.classList.remove("validation-img-error");
            lengthValidationImg.classList.add("validation-img-correct")
      }
      else {
            lengthValidationImg.classList.remove("validation-img-correct")
            lengthValidationImg.classList.add("validation-img-error");
      }

      if (pw.search(/[a-z]/) >= 0) {
            lowerValidationImg.classList.remove("validation-img-error");
            lowerValidationImg.classList.add("validation-img-correct")
      }
      else {
            lowerValidationImg.classList.remove("validation-img-correct")
            lowerValidationImg.classList.add("validation-img-error");
      }

      if (pw.search(/[A-Z]/) >= 0) {
            upperValidationImg.classList.remove("validation-img-error");
            upperValidationImg.classList.add("validation-img-correct")
      }
      else {
            upperValidationImg.classList.remove("validation-img-correct")
            upperValidationImg.classList.add("validation-img-error");
      }

      if (pw.search(/[0-9]/i) >= 0) {
            numberValidationImg.classList.remove("validation-img-error");
            numberValidationImg.classList.add("validation-img-correct")
      }
      else {
            numberValidationImg.classList.remove("validation-img-correct")
            numberValidationImg.classList.add("validation-img-error");
      }

      if (pw.search(/[\W_]/i) >= 0) {
            specialcharValidationImg.classList.remove("validation-img-error");
            specialcharValidationImg.classList.add("validation-img-correct")
      }
      else {
            specialcharValidationImg.classList.remove("validation-img-correct")
            specialcharValidationImg.classList.add("validation-img-error");
      }
}

function CheckIfValidEmail() {
      let input = document.getElementById("email").value;

      if (!input){
            return;
      }

      let validationImg = document.getElementById('email-validation-img');
      let container = document.getElementById('email-validation-infobox');

      if (input.lastIndexOf(".") > input.indexOf("@") + 2 
      && input.indexOf("@") > 0 
      && input.length - input.lastIndexOf(".") > 2) {
            validationImg.classList.add("validation-img-correct")
            validationImg.classList.remove("validation-img-error")
      }
      else {
            validationImg.classList.add("validation-img-error")
            validationImg.classList.remove("validation-img-correct")
      }
      container.style.display = "flex";
}

function CheckIfValidUsername() {
      let input = document.getElementById("username").value;

      if (!input){
            return;
      }
      
      let validationImg = document.getElementById('username-validation-img');
      let container = document.getElementById('username-validation-infobox');

      if (input.length >= 4) {
            validationImg.classList.add("validation-img-correct")
            validationImg.classList.remove("validation-img-error")
      }
      else {
            validationImg.classList.add("validation-img-error")
            validationImg.classList.remove("validation-img-correct")
      }
      container.style.display = "flex";
}