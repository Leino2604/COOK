
const MAX_FIELD_LENGTH = 60;
const MIN_FIELD_LENGTH = 8;
const FIELD_TOO_LONG = "Maximum length allowed is 60";
const FIELD_REQUIRED = "Required field";
const FIELD_EMAIL_PATTERN_MISMATCHED = "Must have pattern example@abc.com"
const FIELD_PASSWORD_MIN_LENGTH = "At least 8 characters";
const FIELD_PASSWORD_PATTERN_MISMATCHED = "Must contain at least one number and one special character";
const FIELD_CONFIRM_PASSWORD_WRONG = "Not matched password";
const EXISTED_EMAIL = "Email already signed up";

/**
 * 
 * @param {HTMLElement} radioContainer
 * @returns {void}
 */
function toggleLoginAndSignupRadios(radioContainer) {
  let accordionClassName = radioContainer.id + "-accordion";
  let selectedAccordion = document.querySelector("." + accordionClassName);
  if (selectedAccordion.classList.contains("hidden")) {
    let activeAccordion = document.querySelector(".active");
    activeAccordion.classList.remove("active");
    activeAccordion.classList.add("hidden");
    selectedAccordion.classList.remove("hidden");
    selectedAccordion.classList.add("active");
  }
}
let radioContainerList = document.querySelectorAll(".radio-container");
radioContainerList.forEach((radioContainer) => radioContainer.addEventListener("click", function (e) {
  toggleLoginAndSignupRadios(this);
}));

/**
 * 
 * @param {String} email
 * @returns {boolean}
 */
function validateEmail(email) {
  let errorMsg = document.getElementById("email-error");
  let emailPattern = new RegExp("[a-zA-Z0-9_]+@[a-zA-Z]+(.[a-zA-Z]+)+");
  if (email === "") {
    errorMsg.innerText = FIELD_REQUIRED;
    return false;
  }
  if (email.length > MAX_FIELD_LENGTH) {
    errorMsg.innerText = FIELD_TOO_LONG;
    return false;
  }
  if (!email.match(emailPattern)) {
    errorMsg.innerText = FIELD_EMAIL_PATTERN_MISMATCHED;
    return false;
  }
  return true;
}

/**
 * 
 * @param {String} password
 * @param {String | null} confirmedPassword 
 */
function validatePassword(password, confirmedPassword = null) {
  /* password between 7 to 15 characters which contain at least one numeric digit and 
    a special character */
  let passwordPattern = new RegExp(
    "^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,60}$"
  );
  /* are currently logging in */
  if (confirmedPassword === null) {
    let errorMsg = document.getElementById("login-password");

    if (password.length < MIN_FIELD_LENGTH) {
      errorMsg.innerText = FIELD_PASSWORD_MIN_LENGTH;
      return false;
    }
    if (password.length > MAX_FIELD_LENGTH) {
      errorMsg.innerText = FIELD_PASSWORD_MIN_LENGTH;
      return false;
    }
    if (!password.match(passwordErrorMsg)) {
      errorMsg.innerText = FIELD_PASSWORD_PATTERN_MISMATCHED;
      return false;
    }
    return true;
  }
  let passwordErrorMsg = document.getElementById("signup-password-error");
  let confirmPasswordErrorMsg = document.getElementById("confirm-password-error");
  console.log(confirmPasswordErrorMsg);
  if (password.length < MIN_FIELD_LENGTH) {
    passwordErrorMsg.innerText = FIELD_PASSWORD_MIN_LENGTH;
    return false;
  }
  if (password.length > MAX_FIELD_LENGTH) {
    passwordErrorMsg.innerText = FIELD_TOO_LONG;
    return false;
  }
  if (!password.match(passwordPattern)) {
    passwordErrorMsg.innerText = FIELD_PASSWORD_PATTERN_MISMATCHED;
    return false;
  }
  if (password !== confirmedPassword) {
    confirmPasswordErrorMsg.innerText = FIELD_PASSWORD_PATTERN_MISMATCHED;
    return false;
  }
  return true;
}

/**
 * @returns {void}
 */

function removeAllErrorMessages() {
  let errorMessageList = document.querySelectorAll(".error");
  if (!errorMessageList) return;
  errorMessageList.forEach((errorMsg) => {
    errorMsg.innerText = "";
  });
}

/**
 * @return {boolean}
 */
function isSigningUp() {
  let activeAccordionClassName = document.querySelector(".active").classList[1];
  return activeAccordionClassName === "signup-accordion";
}

/**
 * 
 * @param {Event} e 
 */
function submitForm(e) {
  e.preventDefault();
  console.log("submit");
  removeAllErrorMessages();
  let email = document.getElementById("email-input").value;
  if (!validateEmail(email)) return;
  if (isSigningUp()) {
    let password = document.getElementById("signup-password-input").value;
    let confirmedPassword = document.getElementById("confirm-password-input").value;
    
    if (!validatePassword(password, confirmedPassword)) return;
  }
  let password = document.getElementById("login-password-input").value;
  if (!validatePassword(password)) return;
}
let form = document.querySelector(".form");
form.addEventListener("submit", (e) => submitForm(e));

